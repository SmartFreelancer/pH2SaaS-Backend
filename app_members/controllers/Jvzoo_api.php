<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jvzoo_api extends MY_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $res = curl_api('https://api.jvzoo.com/v2.0/recurring_payment/AP-9V831604LG164193L');

     // echo "<pre>";
      //var_dump($res);
     // echo "</pre>";

      echo "<pre>";
      var_dump($res['results']);
      echo "</pre>";
   }


}