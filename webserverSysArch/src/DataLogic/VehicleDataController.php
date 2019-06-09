<?php
class VehicleDataController 
{
        public function getcurrentData()
        {
            $refVehicleDataModel = new VehicleDataModel();
            $data = $refVehicleDataModel->getCurrentSensorData(1);
            return $data;
        }
}

?>