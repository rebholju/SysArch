<?php
/** Class to save the Messages which will be presented to the user.
 * the Class has a constructor which can't be called because it's done
 * with a singelton pattern. 
 */
class MessageHandler{
      
   
    protected static $_instance = null;
    private $Message;
    /**Constructor of the class which can't be called 
     * 
     */
    protected function MessageHandler () {}
    
    /** Method that returns the instance which can be used
     * 
     * @return MessageHandler
     */
    public static function getInstance () 
    {
        if (self::$_instance == null) 
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /**Method that prints the Message on the website 
     * 
     */
    public function getMessage()
    {
        echo $this->Message;
        $this->Message = null;
    }
    
    /** Method that adds the Message to the existing messages
     * 
     * @param $Message
     */
    public function AddMessage($Message)
    {
        $this->Message .= $Message;
    }
}
