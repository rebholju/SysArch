<?php 
	require_once('src/phpMQTT/phpMQTT.php');

    $server = "ea-pc165.ei.htwg-konstanz.de";     // change if necessary
    $port = 8883;                                 // change if necessary
    $username = "W4";                             // set your username
    $password = "DEF";                            // set your password
    $client_id = "SysArch_Webservice4";           // make sure this is unique for connecting to sever - you could use uniqid()

function subscribe ($server, $port, $client_id) 
{
    $mqtt = new phpMQTT($server, $port, $client_id);

    if(!$mqtt->connect(true, NULL, $username, $password)) 
    {
	    exit(1);
    }

    $topics['SysArch/W4'] = array("qos" => 0, "function" => "procmsg");
    $mqtt->subscribe($topics, 0);

    while( $mqtt->proc() )
    {}

    $mqtt->close();

    function procmsg($topic, $msg)
    {
		echo "Msg Recieved: " . date("r") . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
    }

}

function publish ()
{
    $mqtt = new phpMQTT($server, $port, $client_id);

    if ($mqtt->connect(true, NULL, $username, $password)) 
    {
	    $mqtt->publish("bluerhinos/phpMQTT/examples/publishtest", "Hello World! at " . date("r"), 0);
	    $mqtt->close();
    } 
    else 
    {
        echo "Time out!\n";
    }

}

?>