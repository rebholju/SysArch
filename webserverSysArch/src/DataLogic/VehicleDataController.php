<?php
class VehicleDataController 
{
        public function getCurrentData()
        {
            $vehicleNumber = getVehicleNumber($_SESSION['username']);
            $refCurrentVehicleDataModel = new VehicleDataModel();
            $data = $refCurrentVehicleDataModel->getCurrentSensorData($vehicleNumber);
            return $data;
        }

        public function getHistoricalData()
        {
            $vehicleNumber = getVehicleNumber($_SESSION['username']);
            $refHistoricalVehicleDataModel = new VehicleDataModel();
            $data = $refHistoricalVehicleDataModel->getHistoricalSensorData($vehicleNumber);
            return $data;
        }

        public function setVehicleData($MQTT)
        {
            $vehicleNumber = getVehicleNumber($_SESSION['username']);
            $refHistoricalVehicleDataModel = new VehicleDataModel();
            setSensorData($MQTT, $vehicleNumber);
        }
}

?>