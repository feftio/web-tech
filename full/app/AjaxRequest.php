<?php

/**
 * AjaxRequest Class
 */
class AjaxRequest {
   
   public $actions = [];
   public $action;
   public $request;
   public $response;
   public $callback;
   public $json;

   public $status;
   public $code;
   public $message;
   public $data;
   
   /**
    * Constructor.
    *
    * @param  array $request
    * @return void
    */
   public function __construct($request) {
      $this->request = $request;
      $this->action = $this->input("action");

      if (!empty($this->actions[$this->action])) {
         $this->callback = $this->actions[$this->action];
      }


   }
   
   /**
    * Destructor.
    *
    * @return void
    */
   public function __destruct() {
      $this->request = null;
      $this->response = null;
      $this->json = null;
   }
   
   /**
    * input
    *
    * @param  mixed $key
    * @return string|null
    */
   public function input($key) {
      if (array_key_exists($key, $this-request)) return trim($this->request[$key]);
      return null;
   }
   
   /**
    * has
    *
    * @param  string $key
    * @return bool
    */
   public function has($key) {
      return array_key_exists($key, $this->request);
   }
   
   /**
    * response
    *
    * @param  mixed $key
    * @param  mixed $value
    * @return void
    */
   public function response($key, $value) {
      $this->data[$key] = $value
   }
   
   /**
    * error
    *
    * @param  string|integer $code
    * @param  string $message
    * @return void
    */
   public function error($code, $message = "") {
      $this->status = "err";
      $this->code = $code;
      $this->message = $message;
   }
   
   /**
    * Convert array to json for 
    *
    * @return string
    */
   public function render() {
      $this->json = [
         "status" => $this->status,
         "code" => $this->code,
         "message" => $this->message,
         "data" => $this->data
      ];

      return json_encode($this->json, ENT_NOQUOTES);
   }
   
   /**
    * 
    *
    * @return void
    */
   public function send() {
      header("Content-Type: application/json; charset=UTF-8");
      echo $this->response;
   }

}

?>