<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Question;
use App\Models\DocumentRightSection;
use App\Models\SaveContractQuestion;
use PDF;

class UserController extends Controller
{
    // public function register(){
    //     return view('users.register.register');
    // }

    public function dashboard(){
        $document_id = 3;
        return view('users.dashboard.user_dashboard',compact('document_id'));
    } 

    public function generatePDF(Request $request){
        $user_id = auth()->user()->id;
        $id = $request->id;
        $document = Document::find($id);
        $savedQuestions = SaveContractQuestion::where([['document_id', $id],['user_id', $user_id]])->get();
        // $savedQuestions = SaveContractQuestion::where([['document_id', $id],['user_id', $user_id]])
        //             ->whereNotNull('answer')
        //             ->get();

        $savedQueIds = $savedQuestions->pluck('question_id')->toArray();
        // return $savedQueIds;


        $questions = Question::where('document_id',$id)->with(['questionData', 'conditions', 'options', 'nextQuestion'])->get();
        $documentContents = DocumentRightSection::where('document_id', $id)->get();

        $filteredContents = $documentContents->filter(function($content) use ($savedQueIds){
            return preg_match('/#(\d+)#/', $content->content, $matches) && in_array($matches[1], $savedQueIds);
        });

        foreach($filteredContents as $content){
            $content->content = preg_replace_callback(
                '/#(\d+)#/',
                function($matches)use($savedQueIds){
                    $classNumber = $matches[1];
                    if(in_array($classNumber, $savedQueIds)){
                        return "<span class=\"answered_spns qidtarget-$classNumber\">_______</span>";
                    }
                    return $matches[0]; // Leave unchanged if not found
                },
                $content->content
            );
    
            $content->content = preg_replace_callback(
                '/{abclist1}/',
                function ($matches) {
                    return "<span class=\"abclist abclist1\"></span>";
                },
                $content->content
            );
    
            if($content->secure_blur_content){
                $content->content = $this->encryptText($content->content, "test");
            }
        }
    
        $data = ['document_content' => $filteredContents, 'saved_questions' => $savedQuestions];
        $pdf = PDF::loadView('users.pdf.contract_pdf', $data);
        return $pdf->download('document.pdf');
    }

    private function encryptText($text, $key){
        $cipherMethod = "AES-256-CBC";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipherMethod)); // Generate a secure IV
        // Encrypt the text
        $encryptedText = openssl_encrypt($text, $cipherMethod, $key, 0, $iv);
        // Encode IV with the encrypted text
        return base64_encode($iv . $encryptedText);
    }
}