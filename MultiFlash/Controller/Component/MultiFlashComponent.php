<?php

    /**
    * Component for allowing multiple "flash" messages to be shown at the same time.
    * @property SessionComponent $Session
    */
    class MultiFlashComponent extends Component
    {
        private $sessionVar = 'MultiFlash.messages';
        
        public $components = array(
            'Session'
        );
        
        public function __construct(ComponentCollection $collection, $settings = array())
        {
            parent::__construct($collection, $settings);
            
            $this->Session->write('MultiFlash.var', $this->sessionVar);
        
        }
        
        
        public function flash($msg, $type = 'error')
        {
            if ($this->Session->check($this->sessionVar))
            {
                $messages = $this->Session->read($this->sessionVar);
            }
            else
            {
                $messages = array();
            }
            
            $messages[] = array(
                'message' => $msg,
                'class' => $type
            );
            $this->Session->write($this->sessionVar, $messages);
        }
        
    
    }

?>