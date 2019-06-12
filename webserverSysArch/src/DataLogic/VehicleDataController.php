<?php
class VehicleDataController 
{
    private $refVehicleDataModel;
    
    public function __construct()
    {
        $this->refVehicleDataModel = new VehicleDataModel();
    }
    
        public function getCurrentData()
        {
            $username = $_SESSION['username'];
            $data = $this->refVehicleDataModel->getCurrentSensorData($username);
            return $data;
        }

        public function getHistoricalData()
        {        
            $username = $_SESSION['username'];
            $data = $this->refVehicleDataModel->getHistoricalSensorData($username);
            return $data;
        }

        public function setVehicleData($MQTT)
        {
            //vehiclenumber kommt von Mqttprotokoll
            
            $MQTT = file_get_contents("example_2.json");
            $vehicleNumber=1;
            $this->refVehicleDataModel->setSensorData($MQTT, $vehicleNumber);
        }
        
        public function newVehicle()
        {
            $vehicleNumber = $_POST['vehicleNumber'];
            $this->refVehicleDataModel->registerNewVehicle($vehicleNumber);
        }
}

?>