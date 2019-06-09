<?php
class CommandInterpreter
{
    
    public function analyseCommand($command)
    {
        if($command=="HistoricalData")
        {
            $view = new HomeView();
            $view->generatePage();
            echo "test";
        }
    }
    
}