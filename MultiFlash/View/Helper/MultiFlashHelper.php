<?php

    /* /app/View/Helper/MultiFlashHelper.php */
    App::uses('AppHelper', 'View/Helper');

    /**
    * Helper that creates a div containing the flash messages.
    *
    */
    class MultiFlashHelper extends AppHelper 
    {

        protected $settings = array(
            'id' => 'MultiFlash'
        );
            
        public $helpers = array('Html', 'Session');
        
        /**
        * Prints a div containing all the flash messages.
        * Each message is only printed once even if it is in the array multiple times.
        */
        public function flash() 
        {
            $result = '';
            if ($messages = $this->Session->read($this->Session->read('MultiFlash.var')))
            {   
                
                $flashedMsgs = array();
                foreach($messages as $k=>$v)
                {
                    if (!in_array($v['message'], $flashedMsgs))
                    {
						$span = $this->Html->tag('span', $v['message']);
                        $result .= $this->Html->tag('li', $span, array('class' => $v['class']));
                        $flashedMsgs[] = $v['message'];
                    }
               }
               CakeSession::delete($this->Session->read('MultiFlash.var'));
            }
            return $this->Html->tag('ul', $result, array('id' => $this->settings['id']));
        }
        
        
        public function css()
        {
            return $this->Html->css('MultiFlash.multiflash');
        }
    }
?>