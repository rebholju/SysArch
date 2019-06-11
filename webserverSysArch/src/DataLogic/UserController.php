<?php
	class UserController
	{
	   private $refCurrentUserDataModel;
	   
	   public function __construct()
	   {
	       $this->refCurrentUserDataModel = new UserDataModel();
	   }
	    //Function to login User
        public function login() 
        {

                $username_email = $_POST['uid'];
                $password = $_POST['pwd'];
            

            
            $status = $this->refCurrentUserDataModel->loginUser($username_email, $password);

            if($status)
            {
                $view = new HomeView(TRUE);
	            $view->generatePage();
	            return true;
            }
            else{
                $this->refCurrentUserDataModel->logoutUser();
                $view = new LoginView(TRUE);
	            $view->generatePage();
	            return false;
            }
         
            
            

        }
        
        public function Signup()
        {
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $lastname = $_POST['lastname'];
            
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $rfidID = $_POST['rfidID'];
            
            $this->refCurrentUserDataModel->signupUser($firstname, $lastname, $email, $username, $pwd, $rfidID);
        }
        

    }