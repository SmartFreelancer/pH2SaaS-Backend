<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   // Show page error that may occur via ajax request
   if ( ! function_exists('inner_page_error')) {
      function inner_page_error($message) {
         $CI = &get_instance();
         $data['error_msg'] = $message;
         echo $CI->load->view('errors/inner_page', $data);
      }
   }

   // Search within an array for a value
   // Return the array that matches the search key
   if ( ! function_exists('search_array_func')) {
      function search_array_func($array, $key, $value) {
         $results = array();
         if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
               $results[] = $array;
            }
            foreach ($array as $subarray) {
               $results = array_merge($results, search_array_func($subarray, $key, $value));
            }
         }
         return $results;
      }
   }

   // CURL Function to scrape data from a given page
   // RETURN data on success - Log error if failed
   if ( ! function_exists('page_get')) {
      function page_get($page_url) {
         $ch = curl_init();

         $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
         $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
         $header[] = "Cache-Control: max-age=0";
         $header[] = "Connection: keep-alive";
         $header[] = "Keep-Alive: 300";
         $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
         $header[] = "Accept-Language: en-us,en;q=0.5";
         $header[] = "Pragma: "; //browsers keep this blank.

         curl_setopt($ch, CURLOPT_URL, $page_url);
         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3');
         curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
         curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
         curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
         curl_setopt($ch, CURLOPT_AUTOREFERER, true);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_TIMEOUT, 300);
         $out = curl_exec($ch);

         if (!$out) {
            // Log Error - WHERE & ERROR MSG
            log_message('error', '
            <strong>WHERE:</strong> helpers/codeify_helper.php <em>(page_get)</em> <br>
            <strong>ERROR MSG:</strong> CURL Failed -> cURL error number: '.curl_errno($ch).' :-: cURL error: '.curl_error($ch).'
            <br><br><hr><br><br>');
            return FALSE;
         } else {
            return $out;
         }
         curl_close($ch);
      }
   }

   // Search thru an array using the field and value
   // RETURN the array key associated with the array
   if ( ! function_exists('get_array_key')) {
      function get_array_key($array, $field, $value) {
         foreach($array as $key => $arr) {
            if ( $arr[$field] == $value )
            return $key+1;
         }
         return false;
      }
   }

   // CURL Function to interact with a REST API
   // RETURN data on success - Log error if failed
   if ( ! function_exists('curl_api')) {

      function curl_api($url) {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_USERPWD, '2173e89d60a67969ea9bf3af8be89d6f567a8b0f27045c24eced784b0bb2f89c:x');
         //curl_setopt($ch, CURLOPT_HEADER, true);

         $out = curl_exec($ch);

         //$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
         curl_close($ch);
         $final_data = json_decode($out, true);

         if( isset($final_data->result) ) {
            return FALSE;
         } else {
            return $final_data;
         }
      }

   }