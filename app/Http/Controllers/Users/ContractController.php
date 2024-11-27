<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrepareContract;
use App\Models\PrepareContractWork;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\LoginRegister;
use App\Models\Document;
use App\Models\DocumentCategory;

class ContractController extends Controller
{
    public function lawyerContract(){
        $keys = [
            'title',
            'fb_link',
            'twitter_link',
            'pinterest_link',
            'short_description',
            'description',
            'page_sub_heading',
            'work_main_heading',
            'economical_main_heading',
            'economical_description',
            'button_text',
            'button_link'
        ];

        $results = PrepareContract::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'fb_link' => $results['fb_link']->value ?? null,
            'twitter_link' => $results['twitter_link']->value ?? null,
            'pinterest_link' => $results['pinterest_link']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'description' => $results['description']->value ?? null,
            'page_sub_heading' => $results['page_sub_heading']->value ?? null,
            'work_main_heading' => $results['work_main_heading']->value ?? null,
            'economical_main_heading' => $results['economical_main_heading']->value ?? null,
            'economical_description' => $results['economical_description']->value ?? null,
            'button_text' => $results['button_text']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        $image = PrepareContract::where('key','image')->whereNotNull('media_id')->with('media')->first();
        $work_sec =  PrepareContract::where('key','prepare_work')->with('contract_work','media')->get();
        $products = Product::where('category_id','4')->get();

        return view('users.contracts.prepare_your_contract_with_lawyer',compact('data','image','work_sec','products'));
    }

    public function getContract(Request $request){
        try{
            if(isset($request->id) && $request->id != null){
                $product = Product::find($request->id);

                $response = ([
                    'data'=> $product,
                    'status'=> 200
                ]);

                return response()->json($response);
            } 

        }catch(Exception $e){
            saveLog("Error:", "ContractController", $e->getMessage());
        }
    }

    public function legalDocument(){
        $legal = LoginRegister::where('key','legal')->first();
        $document_category = DocumentCategory::limit(4)->get();
        $alldocuments = Document::where('published',1)->paginate(12);
        return view('users.contracts.legal_document',compact('legal','document_category','alldocuments'));
    }

    public function categoryDetail($slug){
        $category = DocumentCategory::where('slug',$slug)->first();
        $document_category = DocumentCategory::limit(4)->get();
        $alldocuments = Document::where('published',1)->paginate(12);
        return view('users.contracts.category_detail',compact('category','document_category','alldocuments'));
    }

    // public function categoryDetailPage($slug){
    //     print_r($slug);
    // }
}
