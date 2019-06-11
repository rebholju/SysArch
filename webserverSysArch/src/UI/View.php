<?php
abstract class View
{

	protected $logoutState;

	public function __construct($logoutState=false)
	{
		$this->logoutState=$logoutState;
	
	}
	
	
    abstract protected function generateContent();
    
    public function generatePage()
    {
        echo'	<!DOCTYPE html>
                <html lang="de">
                <head>
                <title>SysArch</title>
                <link href="src/UI/stylesheet.css" rel="stylesheet">
                </head>
            	<div id="head">
                <a id="title">System Architecture Webserver</a>';
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
                echo '<a id="loggedinas">' ?><?php echo $username;?><?php ;
        
                echo'
                    </a>
                    <form action="?command=logout" method="post">
                    <button type="submit" >logout</button>
                    </form>
                    </div>
                
                    <div id="nav">
                    <a id="red" href="index.php?command=HomeView">Home</a>
                    <a id="orange" href="index.php?command=HistoricalDataView">HistoricalData</a>
                    <a id="green" href="index.php?command=ActualDataView">ActualData</a>';
                $user = new UserController();
                if($user->getRole()==10)
                {
                    echo'
                        <a id="blue" href="index.php?command=UserDataView">AddUser</a>
                        </div>';
                }
        }
                
                
        $this -> generateContent();  
        
        $Message = MessageHandler::getInstance();
        $Message->getMessage();
        
    }
}
?>