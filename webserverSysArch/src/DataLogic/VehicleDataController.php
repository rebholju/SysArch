<?php
class VehicleDataController 
{
        public function getcurrentData()
        {
            $vehicleNumber = getVehicleNumber($_SESSION['username']);
            $refVehicleDataModel = new VehicleDataModel();
            $data = $refVehicleDataModel->getCurrentSensorData($vehicleNumber);
            return $data;
        }
}

?>