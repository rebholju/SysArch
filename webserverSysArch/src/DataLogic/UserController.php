<?php
/**Class that handles the connection between the view and 
 * the database
 *
 */
	class UserController
	{
	   private $refCurrentUserDataModel;
	   
	   /** Constructor of the class. The constructor generates
	    * a instance of the UserDataModel
	    */
	    public function __construct()
	   {
	       $this->refCurrentUserDataModel = new UserDataModel();
	   }

	   /** Method that gets the Userinput and calls the login
	    * method of the UserDataModel class
	    * 
	    * @return boolean
	    */
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
        
        /** Method that calls the logout method of the
         * UserDataModel class
         * 
         */
        public function UserLogout()
        {
            $this->refCurrentUserDataModel->logoutUser();
        }
        
        /** Method that gets the userinput and calls the singup
         * method of the USerDataModel class
         * 
         * @return boolean
         */
        public function Signup()
        {
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $rfidID = $_POST['rfidID'];
            
           $success = $this->refCurrentUserDataModel->signupUser($firstname, $lastname, $email, $username, $pwd, $rfidID);
           
           return $success;
        }
        
        /**Method that gets the username from the session and calls the getRole
         * mehtod of the UserDataModel class
         * 
         * @return mixed
         */
        public function getRole()
        {
            $username = $_SESSION['username'];
            $role = $this->refCurrentUserDataModel->getUserRole($username);
            return $role;
        }
        
        /** Method that returns all Userdata
         * 
         * @return mixed[]
         */
        public function getAllUserData()
        {
            $refUserController = new UserController();
            
            if($refUserController->getRole()==10 && ($_GET['command']=='OptionsView' ||
                $_GET['command']=='DeleteUser' || $_GET['command'] == "Signup" || $_GET['command']=="NewVehicle"))
            {
                $userdata = $this->refCurrentUserDataModel->getUserData();
                return $userdata;
            }
            else
            {
                $username = $_SESSION['username'];
                $userdata = $this->refCurrentUserDataModel->getOwnUserData($username);
                return $userdata;
            }
        }
        
        /** Method that calls the resetpwd
         * method of the UserDataModel class
         */
        public function resetpasswordrequest()
        {
            $email = $_POST['email'];
            $this->refCurrentUserDataModel->resetpwdrequest($email);
        }
        
        /** Method that gets the user input and  calls the resetpwd
         * method of the UserDataModel class 
         */
        public function resetpasswordbyEmail()
        {
             $email = $_POST['email'];
            $resetpwd = $_POST['resetpwd'];
            $newpwd = $_POST['newpwd'];
            $this->refCurrentUserDataModel->resetpwd($email, $resetpwd, $newpwd);
        }
        
        /** Method that gets the user id and deletes this user
         * 
         */
        public function deleteUser()
        {
            $userId= $_GET['number'];
            $this->refCurrentUserDataModel->deleteUserfromDatabase($userId);
            
        }
        
        /** Method that gets the user id and edits this userdata
         *
         */
        public function editUser()
        {
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $oldpwd = $_POST['oldpwd'];
            $newpwd = $_POST['newpwd'];
            $rfidID = $_POST['rfidID'];
            $userId = $_GET['number'];
            
            $this->refCurrentUserDataModel->editUserinDatabase($firstname, $lastname, $email, $username, $oldpwd, $newpwd, $rfidID, $userId);
        }

    }