<?php
class MessageHandler{
      
   
    protected static $_instance = null;
    
    protected function MessageHandler () {}
    // Eine Zugriffsmethode auf Klassenebene, welches dir '''einmal''' ein konkretes
    // Objekt erzeugt und dieses zurückliefert.
    public static function getInstance () 
    {
        if (self::$_instance == null) 
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    private $Message;
    public function getMessage()
    {
        echo $this->Message;
        $this->Message = null;
    }
    
    public function AddMessage($Message)
    {
        $this->Message .= $Message;
    }
}
