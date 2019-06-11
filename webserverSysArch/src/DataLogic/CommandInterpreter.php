<?php
class CommandInterpreter
{
    
    public function analyseCommand($command)
    {
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
        
        elseif($command=="SignupView")
        {
            $view=new SignupView();
            $view->generatePage();
            
        }
        elseif($command == "Signup")
        {
            $user = new UserController();
            $user->Signup();
            $view= new SignupView();
            $view->generatePage();
        }
    }
    
}