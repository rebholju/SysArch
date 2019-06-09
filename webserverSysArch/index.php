
	<?php 
	require_once('src/DataLogic/UserClass.php');
	//require_once('src/DataLogic/resetPwd.php');
	require_once('src/DataLogic/UserDataModel.php');
	require_once('src/DataLogic/CommandInterpreter.php');
	require_once('src/DataLogic/MessageHandler.php');
	require_once('src/DataLogic/VehicleDataModel.php');
	
	//View
	require_once('src/UI/View.php');
	require_once('src/UI/LoginView.php');
	require_once('src/UI/HomeView.php');
	require_once('src/UI/SignupView.php');
	require_once('src/UI/ResetPwdView.php');
	require_once('src/UI/ResetPwdFromEmailView.php');
	require_once('src/UI/HistoricalDataView.php');
	require_once('src/UI/ActualDataView.php');
	
	
	
//  	$test = new VehicleDataModel();
//  	$test->setSensorData('noch kein file', 1);
//  	echo 'current Data';
//  	$test->getCurrentSensorData(1);
//  	echo 'historical Data';
//  	$test->getHistoricalSensorData(1);
        $test = new UserDataModel();
       $test2 = $test->authetficateDriver(12345);
        if($test2==true)
        {
            echo 'gelungen';
        }
        else {
            
            echo'fehler';
        }
	main();
	
	function main()
	{
	    session_start();

	    if (isset($_SESSION['softwareName']))
	    {
	    
	        if ($_SESSION['softwareName'] != 'SysArchWeb')
	        {
	            
	            logout();
	        }
	    }
	    else
	    {
	        // also die app setzen auf HANS
	        $_SESSION['softwareName'] = 'SysArchWeb';
	    }


	    if(!isset($_GET['command']))
	    {
	        logout();
	    
	    }
	    else {
	    $command = $_GET['command'];
	    
	    if($command=="login")
	    {
	        login();
	    
	    }
	    else if($command == "logout")
	    {
            logout();
	    }
	    else if($command == "SignupView"|| $command == "Signup")
	    {
	       signup($command);
	        
	    }
	    else if($command == "resetpwdView" || $command == "resetpwd" || $command == "resetpwdfromemailView" || $command == "resetpwdfromemail")
	    {
	        resetpwd2($command);
	    }
	    
	    else if(isset($_SESSION['username']))
	    {
	        $Interpreter = new CommandInterpreter();
	        $Interpreter->analyseCommand($command);
	    }
	    }
	}
	
	
	
	
	
	function login()
	{
	    $refUserController = new UserController();
	    $result=$refUserController->login();
	    if($result==false)
	    {
	        logout();
	    }
	    
	}
	
	function logout()
	{
	    $userclass = new UserClass();
	    $userclass->UserLogout();
	    $view = new LoginView(TRUE);
	    $view->generatePage();
	}
	
	function resetpwd2($command)
	{
	    if($command == "resetpwdView" || $command == "resetpwd")
	    {

	    	    
        if($command == "resetpwd")
	    {
	        $pdo = new UserDataModel();
	        $pdo->resetpwdrequest();
	        
	    }
	    $view = new ResetPwdView(TRUE);
	    $view->generatePage();
	    }

	    if($command == "resetpwdfromemailView" || $command == "resetpwdfromemail")
	    {
	     if($command == "resetpwdfromemail")
	     {
	         $pdo = new UserDataModel();
	         $pdo->resetpwd();

	     }
	     $view = new ResetPwdFromEmailView();
	     $view->generatePage();
	    }

	    

	    }
	        
	
	
	
	   ?>



