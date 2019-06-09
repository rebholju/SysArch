<?php
	class UserController
	{
        public function login() 
        {

                $username_email = $_POST['uid'];
                $password = $_POST['pwd'];
            

            $refCurrentUserDataModel = new UserDataModel();
            $status = $refCurrentUserDataModel->loginUser($username_email, $password);

            if($status)
            {
                $view = new HomeView(TRUE);
	            $view->generatePage();
	            return true;
            }
            else{
                $refCurrentUserDataModel->logoutUser();
                $view = new LoginView(TRUE);
	            $view->generatePage();
	            return false;
            }
            

        }

    }