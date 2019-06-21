<?php
class CommandInterpreter
{
    
    public function analyseCommand($command)
    {
        
        $user = new UserController();
        $role = $user->getRole();
        
        if($command=="login")
        {
            $user = new UserController(); 
            $user->login();
        }

        elseif($command=="HistoricalDataView")
        {
            $view=new HistoricalDataView();
            $view->generatePage();
        }
        
        elseif($command=="ActualDataView")
        {
            $view=new ActualDataView();
            $view->generatePage();
        }
        elseif($command=="HomeView")
        {
            $view=new HomeView();
            $view->generatePage();
        }
        
        elseif($command=="SignupView" && $role == 10)
        {
            $view=new SignupView();
            $view->generatePage();
        }
        elseif($command=="OptionsView" && $role == 10)
        {
            $view = new OptionsView();
            $view->generatePage();
        }
        
        elseif($command=="EditUser")
        {
            $user= new UserController();
            $user->editUser();
            $view=new HomeView();
            $view->generatePage();
        }
        elseif($command == "Signup" && $role == 10)
        {
           $user = new UserController();
          $success = $user->Signup();
          if($success)
          {
           $view= new OptionsView();
           $view->generatePage();
          }
          else
          {
              $view= new SignupView();
              $view->generatePage();
          }
        }
        elseif($command == "NewVehicle"  && $role == 10)
        {
            $vehicle= new VehicleDataController();
            $vehicle->newVehicle();
            $view = new OptionsView();
            $view->generatePage();      
        }
        elseif($command == "DeleteUser"  && $role == 10)
        {
            $user= new UserController();
            $user->deleteUser();
            $view = new OptionsView();
            $view->generatePage();
            
        }
    }
    
}