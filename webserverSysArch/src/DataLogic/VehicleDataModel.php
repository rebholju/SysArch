<?php

class VehicleDataModel
{
    private $pdo;
    
    // creates a connection to the database
    public function __construct()
    {
//         $dsn = 'mysql:host=ea-pc165.ei.htwg-konstanz.de; port=3306 dbname=sysarch_w4';
//          // server=ea-pc165.ei.htwg-konstanz.de;
//         $dbuser = 'sysarch_w4';
//         $dbpwd = 'DEF';
//         //
//         // Hier Datenbank adresse eintragen auf ea-pc165
            $this->pdo = new PDO('mysql:host=localhost; dbname=SysArch','root','');
//        $this->pdo = new PDO($dsn, $dbuser, $dbpwd);
    }
   
    // not used 
    public function setSensorData($JSON, $vehicleNumber)
    {
        
        $answer = "";
        $data = json_decode($JSON, true);

       $username = $data['Passengers'][0]['name'];
       $isPresent = $data['Passengers'][0]['isPresent'];
       if($isPresent)
       {
           for($i=0;$i<sizeof($data['Sensors']);$i++)
           {
               $name = $data['Sensors'][$i]['name'];
               $value = $data['Sensors'][$i]['value'];
               $state = $data['Sensors'][$i]['state'];
               $unit = $data['Sensors'][$i]['unit'];
               $timestamp = $data['Sensors'][$i]['timestamp'];  // timestamp noch in richtiges format dann wieder umkehren ISO 8601
               
               
               if($state=='ON')
               {
                   $statement = $this->pdo->prepare("SELECT sensor FROM vehiclehistoricaldata WHERE vehicleNumber = :vehicleNumber AND sensor = :name");
                   $result = $statement->execute(array( $vehicleNumber, $name));
                   if($result)
                   {
                       //update data
                       $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET  value = ?, timeStamp = ?, driver = ? WHERE vehicleNumber = ? AND sensor = ? ");
                       $result = $statement->execute(array($value, $timestamp, $username, $vehicleNumber, $name));
                       
                       if(!$result)
                       {
                           $answer .= '<div id="loginfalse">Failure when update sensordata!<br>';
                           $answer.= $result;
                       }
                   }
                   else
                   {
                       $statement = $this->pdo->prepare("INSERT INTO vehiclecurrentdata(vehicleNumber, sensor, value, timeStamp, driver)
                   VALUES(?, ?, ?, ?, ?)");
                       $result = $statement->execute(array( $vehicleNumber, $name, $value, $timestamp, $username ));
                       
                       if(!$result)
                       {
                           $answer .= '<div id="loginfalse">Failure when saving new sensordata!<br>';
                           $answer.= $result;
                       }
                   }
                   
                   

                   
                   
                   
                   $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp, driver)
                   VALUES(?, ?, ?, ?, ?)");
                   $result = $statement->execute(array( $vehicleNumber, $name, $value, $timestamp, $username ));
                   
                   if(!$result)
                   {
                   $answer .= '<div id="loginfalse">Failure when saving new sensordata!<br>';
                   $answer.= $result;
                   }
                   
                   
               }
           }           
       }
            
            
            if(!empty($answer))
            {
                $answer .= '</div>';
                $Message = MessageHandler::getInstance();
                $Message->AddMessage($answer);
            }
    }
    
    // returns current sensor data
    public function getCurrentSensorData($username)
    {      
        $answer = "";
        $data = array();
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclecurrentdata WHERE driver = ?");
        $result = $statement->execute(array($username ));
        while ($row = $statement->fetch()) {
            $data[] = $row;
            
        }
        
        if(!$result)
        {
            $answer .= '<div id="loginfalse">Failure when calling current Sensordata from database<br>';
        }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        return $data;
           
    }
    
    // returns all current sensor data
    public function getAllCurrentSensorData()
    {
        $answer = "";
        $data = array();
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclecurrentdata");
        $result = $statement->execute();
        while ($row = $statement->fetch()) {
            $data[] = $row;
            
        }
          
        if(!$result)
        {
            $answer .= '<div id="loginfalse">Failure when calling current sensordata from database<br>';
        }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        return $data;
        
    }
    
    // returns historical sensor data
    public function getHistoricalSensorData($username)
    {
        
        $counter = 0;
        $answer = "";
        $data = array();
        
        
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclehistoricaldata WHERE driver = ?");
        $result = $statement->execute(array( $username ));
        while ($row = $statement->fetch()) {
            $data[] = $row;
            $counter++;
            
        }

        if(!$result)
        {
            $answer .= '<div id="loginfalse">Failure when calling historical sensordata from database<br>';
        }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        
        return $data;
        
    }
    
    // returns historical sensor data
    public function getAllHistoricalSensorData()
    {
        
        $counter = 0;
        $answer = "";
        $data = array();
        
        
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclehistoricaldata");
        $result = $statement->execute();
        while ($row = $statement->fetch()) {
            $data[] = $row;
            $counter++;
            
        }
        
        if(!$result)
        {
            $answer .= '<div id="loginfalse">Failure when calling historical sensordata from database<br>';
        }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        
        return $data;
        
    }
    
    // register new vehicle
    public function registerNewVehicle($vehicleNumber)
    {
        $answer = "";
        $error = false;
        
        $statement = $this->pdo->prepare("SELECT * FROM vehiclehistoricaldata WHERE vehicleNumber = :vehicleNumber");
        $result = $statement->execute(array('vehicleNumber' => $vehicleNumber));
        $vehicle = $statement->fetch();
        
        if($vehicle !== false)
        {
            $answer .= '<div id="loginfalse">Vehiclenumber exists already<br>';
            $error=true;
           
        }
        
        if(!$error)
        {
        $statement = $this->pdo->prepare("SELECT * FROM vehiclecurrentdata WHERE vehicleNumber = :vehicleNumber");
        $result = $statement->execute(array('vehicleNumber' => $vehicleNumber));
        $vehicle = $statement->fetch();
        
        if($vehicle !== false)
        {
            $answer .= '<div id="loginfalse">Vehiclenumber exists already<br>';
            $error=true;        
        }
        }
        
        if((empty($vehicleNumber)|| !is_numeric($vehicleNumber)) && !$error)
        {
            $answer .= '<div id="loginfalse">Type in a Number<br>';
            $error=true; 
        }
        
        if(!$error)
        {
        $statement = $this->pdo->prepare("INSERT INTO vehiclecurrentdata(vehicleNumber, sensor)
                                                            VALUES(?, ?)");
        $result = $statement->execute(array( $vehicleNumber, "no Sensordata yet"));
        
        
        $answer .= '<div id="signupsucess">Vehicle registered</a>';
        
        }
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        
    }

}
?>