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
            $refUserDataModel = new UserDataModel();
            $role = $refUserDataModel->getUserRole($username);
            if($role == 20)
            {
                $data = $this->refVehicleDataModel->getCurrentSensorData($username);
                return $data;
            }
            else if($role == 10)
            {
                $data = $this->refVehicleDataModel->getAllCurrentSensorData();
                return $data;
            }
        }
        

        public function getHistoricalData()
        {       
            $username = $_SESSION['username'];
            $refUserDataModel = new UserDataModel();
            $role = $refUserDataModel->getUserRole($username);
            if($role == 20)
            {
            $data = $this->refVehicleDataModel->getHistoricalSensorData($username);
            return $data;
            }
            else if($role == 10)
            {
                $data = $this->refVehicleDataModel->getAllHistoricalSensorData();
                return $data;
            }
        }

        public function setVehicleData($MQTT)
        {
            //vehiclenumber kommt von Mqttprotokoll
            
            $MQTT = file_get_contents("WikiBeispiel.json");
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