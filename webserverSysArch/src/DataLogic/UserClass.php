
	<?php
	class UserClass
	{
	    function Home()
	    {
	        if(isset($_SESSION['username']))
	        {
	            $view = new HomeView(TRUE);
	            $view->generatePage();
	        }
	    }
	    
	    function UserLogout()
	    {
            $pdo = new UserDataModel();
            $pdo->logoutUser();
	    }
	    }

?>

