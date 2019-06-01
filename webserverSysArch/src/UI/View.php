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
  <a id="title">System Architecture Webserver</a>
    ';
                
                
        $this -> generateContent();  
        
        $Message = MessageHandler::getInstance();
        $Message->getMessage();
        
    }
}
?>