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

        if($command=="HistoricalDataView")
        {
            $view=new HistoricalDataView();
            $view->generatePage();
        }
        
        if($command=="ActualDataView")
        {
            $view=new ActualDataView(getCurrentData());
            $view->generatePage();
        }
        if($command=="HomeView")
        {
            $view=new HomeView();
            $view->generatePage();
        }
        
        if($command=="SignupView")
        {
            $view=new SignupView();
            $view->generatePage();
            
        }
        if($command == "Signup")
        {
            
        }
    }
    
}