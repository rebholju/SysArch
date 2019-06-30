<?php
class VehicleDataController 
{
    private $refVehicleDataModel;
    
        /** Constructor of the class that generates an instance
         * of the VehicleDataModel class
         * 
         */
        public function __construct()
         {
        $this->refVehicleDataModel = new VehicleDataModel();
         }
    
        /** Method that returns the current sensor data by 
         * calling a method from the VehicleDataModel class
         * 
         * @return mixed[]
         */
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
        
        /** Method that returns the current sensor data by 
         * calling a method from the VehicleDataModel class
         * 
         * @return mixed[]
         */
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

        /** Not used anymore. this functionalitiy is done in the Java
         * program. The method wirtes the values from the json file into 
         * the DB
         * 
         * @param  $MQTT
         */
        public function setVehicleData($MQTT)
        {
            //vehiclenumber kommt von Mqttprotokoll
            
            $MQTT = file_get_contents("WikiBeispiel.json");
            $vehicleNumber=1;
            $this->refVehicleDataModel->setSensorData($MQTT, $vehicleNumber);
        }
        
        /** Method that generates a new vehicle without any sensordata
         * 
         */ 
        public function newVehicle()
        {
            $vehicleNumber = $_POST['vehicleNumber'];
            $this->refVehicleDataModel->registerNewVehicle($vehicleNumber);
        }
}

?>