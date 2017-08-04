<?php
	class Login extends CI_Controller
	{
	    
	   	public function __construct()
        {
            parent::__construct();
            // Load facebook library
        	$this->load->library('facebook');
        }
        public function index(){

        	// login with facebook
	        $dataFacebook = $this->myFb();

	        // login with google
	        $dataGoogle = $this->myGg();
	        
	        // data so view
	        $dataAll = array(
	            'dataFb' => $dataFacebook,
	            'dataGg' => $dataGoogle
	        );
	        
	        $this->load->helper('form');
	        $this->load->view("login/login",$dataAll);
		}  

		// function facebook
		public function myFb(){
			$userData = array();

			// Check if user is logged in
	        if($this->facebook->is_authenticated()){
	            // Get user facebook profile details
	            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

	            $userData = array(
				        'id'  => $userProfile['id'],
				        'first_name' => $userProfile['first_name'],
			            'last_name' => $userProfile['last_name'],
			            'email' => $userProfile['email'],
			            'gender' => $userProfile['gender'],
			            'locale' => $userProfile['locale'],
			            'profile_url' => 'https://www.facebook.com/'.$userProfile['id'],
			            'picture_url' => $userProfile['picture']['data']['url']
				);
	            

	            // save session
	            if(!empty($userData)){
	                $userData['userData'] = $userData;
	                $this->session->set_userdata('userData',$userData);
	            }else{
	               $userData['userData'] = array();
	            }

	            // Get logout URL
	            $userData['logoutUrl'] = $this->facebook->logout_url();
	        }
	        else
	        {
	            $fbuser = '';
	            // Get login URL
	            $userData['authUrl'] =  $this->facebook->login_url();
	        }
	        return $userData;
		}
		// logout facebook
		public function myLogoutFb(){
			// delete session
	        $this->facebook->destroy_session();
	        // delete all data from session
	        $this->session->unset_userdata('userData');
	        redirect('/login');
		}

		// function google
		public function myGg(){
			$userData = array();

			// Include the google api php libraries
	        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
	        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

	        // Google Project API Credentials
	        $clientId = '241119000980-bef53f20n7lf98o4k35s0u8dl0sv5a06.apps.googleusercontent.com';
        	$clientSecret = 'i9rX17YjEC7ingAq4JOiqiiu';
        	$redirectUrl = base_url() . 'login';

        	// Google Client Configuration
	        $gClient = new Google_Client();
	        $gClient->setApplicationName('Login to codexworld.com');
	        $gClient->setClientId($clientId);
	        $gClient->setClientSecret($clientSecret);
	        $gClient->setRedirectUri($redirectUrl);
	        $google_oauthV2 = new Google_Oauth2Service($gClient);
			

			if (isset($_REQUEST['code'])) {
	            $gClient->authenticate();
	            $this->session->set_userdata('token', $gClient->getAccessToken());
	            redirect($redirectUrl);
	        }

	        $token = $this->session->userdata('token');

	        if (!empty($token)) {
	            $gClient->setAccessToken($token);
	        }

	        if ($gClient->getAccessToken()) {
	            $userProfile = $google_oauthV2->userinfo->get();

	            $userData = array(
				        'id'  => $userProfile['id'],
				        'first_name' => $userProfile['given_name'],
			            'last_name' => $userProfile['family_name'],
			            'email' => $userProfile['email'],
			            'gender' => $userProfile['gender'],
			            'locale' => $userProfile['locale'],
			            'profile_url' => $userProfile['link'],
			            'picture_url' => $userProfile['picture']
				);

	            if(!empty($userData)){
	                $userData['userData'] = $userData;
	                $this->session->set_userdata('userData',$userData);
	            }else {
	               $userData['userData'] = array();
	            	// $userData['logoutUrl'] = $this->myLogoutGg();
	            	// print_r($userData['logoutUrl']);
	            	
	            }
	            //$userData['logoutUrl'] = $this->myLogoutGg();
        	} 
        	else 
        	{
            	$userData['authUrl'] = $gClient->createAuthUrl();
        	}
        	// print_r($userData);
        	return $userData;
		}

		// logout google
		public function myLogoutGg() {
	        $this->session->unset_userdata('token');
	        $this->session->unset_userdata('userData');
	        $this->session->sess_destroy();
	        redirect('/login');
    	}
	}
