<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller
{

		public function __construct() {
	        parent::__construct();
	        $this->load->library('excel');//load PHPExcel library 
	        $this->load->library('session');
		}	

		public function index(){
			// $dataUser = $this->ExcelDataAdd();

			// $dataAllUser = array(
	  //           'dt' => $dataUser
	  //       );

			$this->load->view("excel_import");
		}
	
		public	function ExcelDataAdd()	{  

		//Path of files were you want to upload on localhost 	
		$data_user = array();


		$this->load->model('excel_data_model');

        $configUpload['upload_path'] = FCPATH.'uploads/';
        $configUpload['allowed_types'] = 'xls|xlsx|csv';
        $configUpload['max_size'] = '5000';

        $this->load->library('upload', $configUpload);
        if(isset($_POST['upload']))
        {
        	if ( ! $this->upload->do_upload('userfile'))
	        {
	        	echo "file dont correct format,upload failed";
	        }
	        else
	        {

	        		// $this->upload->do_upload('userfile');	
			        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			        $file_name = $upload_data['file_name']; //uploaded file name
					$extension=$upload_data['file_ext'];    // uploaded file extension
					
					//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
			 		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
			        //Set to read only
			        $objReader->setReadDataOnly(true); 		  
			        //Load excel file
					$objPHPExcel=$objReader->load(FCPATH.'uploads/'.$file_name);		 
			        $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			         
			        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			        //loop from first data untill last data
			        for($i=2;$i<=$totalrows;$i++)
			        {
			           $hoten = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
			           $ngaysinh = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
					   $gioitinh = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
					   $diachi =$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
					   $dienthoai =$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
					   $email = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 5		  

					    $dayStringConvert = strtotime(str_replace('/', '-',$ngaysinh));
			            $dayFormat = date("Y-m-d",$dayStringConvert);
					    $data_user= array
								    (
								   		'hoten'=>$hoten, 
								   		'ngaysinh'=>$dayFormat,
								   		'gioitinh'=>$gioitinh ,
								   		'diachi'=>$diachi , 
								   		'dienthoai'=>$dienthoai,
								   		'email' => $email
								   	);
						$this->session->set_userdata($data_user);		   	
					  	$this->excel_data_model->Add_User($data_user);
					  	
					  	$this->session->unset_userdata($data_user);

					  	
			        }
			        
		            unlink('./uploads/'.$file_name); //File Deleted After uploading in database .

		            $this->session->set_flashdata('message', 'Information Has been Successfully Inserted');
		            redirect(base_url() . "excel_import");
	        }
        }

        return $data_user;
    }
	
}
?>