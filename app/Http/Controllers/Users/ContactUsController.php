<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Media;
use App\Services\FileUploadService;
use App\Models\AdminContactUs;
use Exception;
use App\Models\Setting;

class ContactUsController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function index(){
        $contact = AdminContactUs::first();
        return view('users.contact.contactUs',compact('contact'));
    }

    public function contactUsProcc(Request $request){

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'fileInput' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        try{
            $recaptcha = $request->input('g-recaptcha-response');
            $secret_key = env('RECAPTCHA_SECRET_KEY');
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$recaptcha;
            $response_json = file_get_contents($url);
            $response = (array)json_decode($response_json);
    
            if($response['success'] == true){
                $file = $request->file('fileInput');
       
                $contactUs = new ContactUs;
                $contactUs->name = $request->name;
                $contactUs->phone_number = $request->phone_number;
                $contactUs->email = $request->email;
                $contactUs->message = $request->message;
        
                $directory = "public/contact_form_images";
                $fileupload = $this->fileUploadService->upload($file, $directory);
                $fileuploadData = $fileupload->getData();
                
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $contactUs->media_id = $fileuploadData->id;
                    $contactUs->save();
        
                    return redirect()->back()->with('success', 'Thanks for contacting us');
        
                } elseif($fileuploadData->status == '400') {
                    return redirect()->back()->with('error', $fileuploadData->error);
                }
            }else{
                return redirect()->back()->with('error','Google recaptcha is not valid!');
            }
        }catch(Exception $e){
            saveLog("Error:","ContactUsController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
