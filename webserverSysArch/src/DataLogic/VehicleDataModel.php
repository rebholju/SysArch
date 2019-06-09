<?php

class VehicleDataModel
{
    private $pdo;
    public function __construct()
    {
        // Hier Datenbank adresse eintragen auf ea-pc165
        $this->pdo = new PDO('mysql:host=localhost; dbname=SysArch','root','');
    }
   
    //sets the Values given in the JSON file into the current DB and historical DB
    public function SetSensorData($JSON, $vehicleNumber)
    {
        
        $answer = "";
        $JSON = file_get_contents("example_2.json");
        $data = json_decode($JSON, true);
        
        $CPUTemp = $data['CPU']['CPUTemp'];

        $jitter = $data['RT']['jitter'];
        
        $numOfRTThreads = $data['RT']['numOfRTThreads'];

        $LIDAR = $data['Sensors']['LIDAR'];

        $Speed = $data['Sensors']['Speed'];

        $BatteryPower = $data['Sensors']['BatteryPower'];

                            //update data
                            $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET  value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                            $result = $statement->execute(array($CPUTemp, date('Y-m-d H:i:s'), $vehicleNumber, "CPUTemp"));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                    $answer.= $result;
                                }

                            //jitter
                                $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET  value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                                $result = $statement->execute(array( $jitter, date('Y-m-d H:i:s'), $vehicleNumber, "jitter" ));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                }

                            //numOfRTThreads
                            $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET  value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                            $result = $statement->execute(array( $numOfRTThreads, date('Y-m-d H:i:s'), $vehicleNumber, "numOfRTThreads" ));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                }

                            //LIDAR
                            $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET  value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                            $result = $statement->execute(array( $LIDAR, date('Y-m-d H:i:s'), $vehicleNumber, "LIDAR" ));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                }

                            //Speed
                            $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                            $result = $statement->execute(array( $Speed, date('Y-m-d H:i:s'), $vehicleNumber, "Speed" ));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                }

                            //BatteryPower
                            $statement = $this->pdo->prepare("UPDATE vehiclecurrentdata SET value = ?, timeStamp = ? WHERE vehicleNumber = ? AND sensor = ?");
                            $result = $statement->execute(array(  $BatteryPower, date('Y-m-d H:i:s'), $vehicleNumber, "BatteryPower" ));

                            if(!$result)
                                {
                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                }
                                
                                
                                // store historical
                                
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "CPUTemp", $CPUTemp, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                    $answer.= $result;
                                                                }
                                
                                                            //jitter
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "jitter", $jitter, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                }
                                
                                                            //numOfRTThreads
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "numOfRTThreads", $numOfRTThreads, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                }
                                
                                                            //LIDAR
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "LIDAR", $LIDAR, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                }
                                
                                                            //Speed
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "Speed", $Speed, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                }
                                
                                                            //BatteryPower
                                                            $statement = $this->pdo->prepare("INSERT INTO vehiclehistoricaldata(vehicleNumber, sensor, value, timeStamp)
                                                            VALUES(?, ?, ?, ?)");
                                                            $result = $statement->execute(array( $vehicleNumber, "BatteryPower", $BatteryPower, date('Y-m-d H:i:s') ));
                                
                                                            if(!$result)
                                                                {
                                                                    $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                                                                }
                                
                                
                                
                            
                    
                         $answer .= '<div id="signupsucess">Programm ausgefuehrt</a>';
            
            
            if(!empty($answer))
            {
                $answer .= '</div>';
                $Message = MessageHandler::getInstance();
                $Message->AddMessage($answer);
            }
    }
    
    public function getCurrentSensorData($vehicleNumber)
    {
        $answer = "";
        $data = array();
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclecurrentdata WHERE vehicleNumber = ?");
        $result = $statement->execute(array( $vehicleNumber ));
        while ($row = $statement->fetch()) {
            $data[] = $row;
            
        }
        
        // Beispiel wie man daten dann auslesen kann
        echo $data[2]['vehicleNumber'];
        echo '  ';
        echo $data[2]['sensor'];
        echo '  ';
        echo $data[2]['value'];
        echo '  ';
        echo $data[2]['timeStamp'];
        echo '<br>';
        
       
        
        
        if(!$result)
        {
            $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
        }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        
           
    }
    
    public function getHistoricalSensorData($vehicleNumber)
    {
        $counter = 0;
        $answer = "";
        $data = array();
        
        
        $statement = $this->pdo->prepare("SELECT * FROM  vehiclehistoricaldata WHERE vehicleNumber = ?");
        $result = $statement->execute(array( $vehicleNumber ));
        while ($row = $statement->fetch()) {
            $data[] = $row;
            $counter++;
            
        }
        
        // Beispiel wie man daten dann auslesen kann
        for($i=0;$i<$counter;$i++)
        {
        echo $data[$i]['vehicleNumber'];
        echo '  ';
        echo $data[$i]['sensor'];
        echo '  ';
        echo $data[$i]['value'];
        echo '  ';
        echo $data[$i]['timeStamp'];
        echo '<br>';
        }
        
        
        
        
        if(!$result)
        {
            $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
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