<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Register extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                $config = array(
                        array(
                                'field' => 'firstName',
                                'label' => 'First Name',
                                'rules' => 'required'
                        ),
                        array(
                                'field' => 'lastName',
                                'label' => 'Last Name',
                                'rules' => 'required'
                        ),
                        array(
                                'field' => 'email',
                                'label' => 'Email',
                                'rules' => 'trim|required'
                        ),
                        array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'required'
                                
                        ),
                        array(
                                'field' => 'daySelect',
                                'label' => 'Day',
                                'rules' => 'required'
                        ),
                        array(
                                'field' => 'monthSelect',
                                'label' => 'Month',
                                'rules' => 'required'
                        ),
                        array(
                                'field' => 'yearSelect',
                                'label' => 'Year',
                                'rules' => 'required'
                        ),
                        array(
                                'field' => 'gender',
                                'label' => 'Gender',
                                'rules' => 'required'
                        )
                );

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('register');
                }
                else
                {
                        
                        // get data from fields
                        $allField = $this->input->post(
                                array(
                                        "firstName",
                                        "lastName",
                                        "email",
                                        "password",
                                        "daySelect",
                                        "monthSelect",
                                        "yearSelect",
                                        "gender"
                                )
                        );
                        

                        // print_r($allField);
                        $dayString = $allField['yearSelect'].$allField['monthSelect'].$allField['daySelect'];
                        
                        $dayStringConvert = strtotime($dayString);

                        $dayFormat = date("d/M/Y",$dayStringConvert);

                        $ip = $this->input->ip_address();

                        $fullData = array(
                               "firstname" => $allField['firstName'],
                               "lastname"  => $allField['lastName'],
                               "email"     => $allField['email'],
                               "password"  => $allField['password'],
                               "birthday"  => $dayFormat,
                               "gender"    => $allField['gender'],
                               "ip"        => $ip    
                        );
                        
                        $this->load->library("curl");

                        $url = 'http://125.212.253.128:8080/api-rest-user/service/user/signup';

                        // use curl

                        $this->curl->create($url);
                        $this->curl->post($fullData);
                        $result = json_decode($this->curl->execute());
                        
                        if (isset($result->status) && $result->status->success == 1) {
                            redirect('login');
                        }else {
                             echo "Register not successfully,Something has gone wrong";
                        }

                       
                        // $ch = curl_init();
                        // $curl_handle = curl_init();
                        // curl_setopt($curl_handle, CURLOPT_URL, 'http://125.212.253.128:8080/api-rest-user/service/user/signup');
                        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $fullData);
                        // $data = curl_exec($curl_handle);
                        // curl_close($curl_handle);
                        // $result = json_decode($data);
                         
                        // if(isset($result->status) && $result->status == 'success')
                        // {
                        //         echo "Insert data success";
                        // }
                        // else
                        // {
                        //         echo 'Something has gone wrong';
                        // }
                }
        }
}