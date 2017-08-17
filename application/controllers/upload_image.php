<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_image extends CI_Controller {

	// Class constructor
	public function __construct(){
		parent::__construct();
		// load library session, upload, image_lib
		$this->load->library(['session','upload','image_lib']);
	}

	// display page index
	public function index()
	{
		// load view index
		$this->load->view('upload_home');
	}

	// load after image drop
	public function displayAfterCrop()
	{
		// display area view of crop area
		$this->load->view('display_upload');
	}

	// upload image
	public function uploadCrop(){

		// configuration upload image
		// directory upload 
		$configUpload['upload_path']   = './uploads/';
		// allow type file upload image
		$configUpload['allowed_types'] = 'jpg|png';
		
		$configUpload['encrypt_name']  = TRUE;

		// initialize library upload
		$this->upload->initialize($configUpload);

		// check if cannot upload and else
		// if upload success then drop
		if ( ! $this->upload->do_upload('image'))
		{
			// display error and redirect to first page
			$data= array('error' => $this->upload->display_errors());
			$this->load->view('home',$data);
		}
		else
		{
			// get data of image
			$dataImage = $this->upload->data();

			// calculate position cut and
			// relative size of image original
			
			$caclulatepercent = $this->CalculaPercent($this->input->post());

			// Define as configuration parameter of image drop
			// use library image gd2 
			$configCrop['image_library'] = 'gd2';
			//Path image drop 
			$configCrop['source_image']  = $dataImage['full_path'];
			// Directory image drop
			$configCrop['new_image']     = './uploads/crops/';
			// proportion
			$configCrop['maintain_ratio']= FALSE;
			// Quality image
			$configCrop['quality']			 = 100;
			// size of drop image
			$configCrop['width']         = $caclulatepercent['wcrop'];
			$configCrop['height']        = $caclulatepercent['hcrop'];
			
			// point drop (x vs y)
			$configCrop['x_axis']        = $caclulatepercent['x'];
			$configCrop['y_axis']        = $caclulatepercent['y'];

			// configuration parameter a library image_lib
			$this->image_lib->initialize($configCrop);

			// verify drop have or no 
			// if error comeback to home page
			
			if ( ! $this->image_lib->crop())
			{
				// display error and come back to home page
				$data = array('error' => $this->image_lib->display_errors());
				$this->load->view('home',$data);
			}
			else
			{
				
				// Define a URL image generate from drop
				$urlImage = base_url('uploads/crops/'.$dataImage['file_name']);

				// save data in session
				$this->session->set_flashdata('urlImage', $urlImage);

				// save data image drop in session
				$this->session->set_flashdata('dataImage', $dataImage);

				// save data image original in sesison
				$this->session->set_flashdata('dataCrop', $caclulatepercent);

				// redirect to page visualizacao
				redirect('displayAfterCrop');
			}
		}
	}

	// calculate 
	private function CalculaPercent($dimension){

		// check width of root image
		
		if($dimension['woriginal'] > $dimension['wvisual']){
			$percentual = $dimension['woriginal'] / $dimension['wvisual'];

			$dimension['x'] = round($dimension['x'] * $percentual);
			$dimension['y'] = round($dimension['y'] * $percentual);
			$dimension['wcrop'] = round($dimension['wcrop'] * $percentual);
			$dimension['hcrop'] = round($dimension['hcrop'] * $percentual);
		}

		// return width after crop 
		return $dimension;
	}
}
