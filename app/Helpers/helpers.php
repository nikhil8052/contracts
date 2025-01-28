<?php

use App\Models\AppLog;
use App\Models\Setting;
use App\Models\Document;
use Stripe\Customer;
use Stripe\Stripe;

function saveLog($message = "", $filename = "", $payload = [])
{
    $app_log = new AppLog();
    $app_log->message = $message;
    $app_log->filename = $filename;
    $app_log->payload = json_encode($payload, true);
    $app_log->save();
    return true;
}

function web_setting($key = null, $value = false)
{
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

function generateFileName($file)
{
    return time() . rand(1, 50) . '.' . $file->extension();
}

function getFilePath($filePath)
{
    return storage_path('app/' . $filePath);
}

function getOrCreateCustomer()
{
    $user = auth()->user();
    if ($user->stripe_cus_id) {
        return $user->stripe_cus_id;
    }

    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Customer::create([
            'email' => $user->email,
            'name' => $user->name,
            'metadata' => [
                'user_id' => $user->id, 
            ],
        ]);
        $user->stripe_cus_id = $customer->id;
        $user->save();
        return $customer->id;
    } catch (\Exception $e) {
      
     
     
    }
}

function getDocument( $id ){
    return Document::find($id) ?? null ;
}
?>
