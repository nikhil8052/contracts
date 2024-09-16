<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Media;
use App\Services\FileUploadService;
use Exception;
use App\Models\Setting;

class ContactUsController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function index(){
        return view('users.contact.contactUs');
    }

    public function contactUsProcc(Request $request){
        try{
            $file = $request->file('file');
       
            
            $contactUs = new ContactUs;
            $contactUs->name = $request->name;
            $contactUs->phone_number = $request->phone_number;
            $contactUs->email = $request->email;
            $contactUs->message = $request->message;
    
            $fileupload = $this->fileUploadService->upload($file, 'uploads/files');
            
            $fileuploadData = $fileupload->getData();
    
            if(isset($fileuploadData) && $fileuploadData->status == '200'){
                $contactUs->media_id = $fileuploadData->id;
                $contactUs->save();
    
                return redirect()->back()->with('success', 'Thanks for contacting us');
    
            } elseif($fileuploadData->status == '400') {
                return redirect()->back()->with('error', $fileuploadData->error);
            }
    
        }catch(Exception $e){
            saveLog("Error:","ContactUsController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

}
