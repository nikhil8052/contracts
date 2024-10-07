<?php

use App\Models\AppLog;
use App\Models\Setting;

     function saveLog($message="",$filename="", $payload=[] ){
          $app_log = new AppLog;
          $app_log->message= $message;
          $app_log->filename= $filename;
          $app_log->payload= json_encode($payload, true );
          $app_log->save();
          return true; 
     }


     function web_setting($key = null, $value = false){
          $response = null;
          if ($key != null && $value) {
               $setting = Setting::where('key', $key)->first();
               if ($setting) {
                    $response = $setting->value;
               }
          } elseif ($key != null) {
               $response = Setting::where('key', $key)->first();
          } else {
               $response = Setting::pluck('value', 'key')->toArray();
          
          }
          return $response;
     }

     function generateFileName($file){
          return time() . rand(1, 50) . '.' . $file->extension();
     }


?>