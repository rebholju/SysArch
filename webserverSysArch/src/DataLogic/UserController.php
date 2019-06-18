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
	            return false;
            }
         

            

        }
        
        public function UserLogout()
        {
            $pdo = new UserDataModel();
            $pdo->logoutUser();
        }
        
        
        //signup
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
        
        //get Role
        public function getRole()
        {
            $username = $_SESSION['username'];
            $role = $this->refCurrentUserDataModel->getUserRole($username);
            return $role;
        }
        
        
        //get Userdata
        public function getAllUserData()
        {
            $userdata = $this->refCurrentUserDataModel->getUserData();
            return $userdata;
        }
        
        public function resetpasswordrequest()
        {
            $email = $_POST['email'];
            $this->refCurrentUserDataModel->resetpwdrequest($email);
        }
        
        public function resetpasswordbyEmail()
        {
             $email = $_POST['email'];
            $resetpwd = $_POST['resetpwd'];
            $newpwd = $_POST['newpwd'];
            $this->refCurrentUserDataModel->resetpwd($email, $resetpwd, $newpwd);
        }
        

    }