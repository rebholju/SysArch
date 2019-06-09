<?php
class CommandInterpreter
{
    
    public function analyseCommand($command)
    {
        if($command=="HistoricalDataView")
        {
            $view=new HistoricalDataView();
            $view->generatePage();
        }
        
        if($command=="ActualDataView")
        {
            $view=new ActualDataView();
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
    }
    
}