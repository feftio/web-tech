<?php

/**
 * AjaxRequest
 */
class AjaxRequest {

   public $actions = [];
   public $request;

   public $status;
   public $code;
   public $message;
   public $data;

   public function __construct($request) {
      $this->request = $request;
      $this->action = $this->input("act");
   }

   public function __destruct() {
      $this->request = null;
   }

   public function input($name) {
      return;
   }

   public function has($name) {
      return True;
   }

}

?>