<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use App\Models\Work;
use Exception;
use File;

class SiteMetaController extends Controller
{
    public function howItWorks(){
        $howitwork = HowItWork::with('works')->get();

        $keys = [
            'title',
            'main_heading',
            'short_description',
            'join_our_community_text',
            'second_banner_heading',
            'second_banner_sub_heading',
            'button_label',
            'button_link'
        ];

        $results = HowItWork::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'join_our_community_text' => $results['join_our_community_text']->value ?? null,
            'second_banner_heading' => $results['second_banner_heading']->value ?? null,
            'second_banner_sub_heading' => $results['second_banner_sub_heading']->value ?? null,
            'button_label' => $results['button_label']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        return view('admin.site_meta.howItWorks.add_how_it_work', compact('howitwork', 'data'));

    }

    public function addHowItWorks(Request $request){
        try{
            if($request->hasFile('work_image')){
                for($i=0; $i<count($request->file('work_image')); $i++){
                    $file = $request->file('work_image')[$i];
                    $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('site_images'), $filename);
    
                    $work_heading = $request->work_heading[$i];
                    $work_description = $request->work_description[$i];

                    $howitwork = new HowItWork;
                    $howitwork->key = 'work';
                    $howitwork->type = 'work_type';

                    $works = new Work;
                    $works->image = $filename;
                    $works->heading = $work_heading;
                    $works->description = $work_description;
                    $works->save();

                    $howitwork->work_id = $works->id;
                    $howitwork->save();
                }
            }else{
                foreach($request->work_heading as $key=>$value){
                    $works = Work::find($key);
                    $works->heading = $value;
                    $works->update();
                }

                foreach($request->work_description as $id=>$description){
                    $works = Work::find($id);
                    $works->description	= $description;
                    $works->update();
                }
            }

            if($request->hasFile('new_work_image')){
                for($i=0; $i<count($request->file('new_work_image')); $i++){
                    $file = $request->file('new_work_image')[$i];
                    $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('site_images'), $filename);
    
                    $new_work_heading = $request->new_work_heading[$i];
                    $new_work_description = $request->new_work_description[$i];

                    $howitwork = new HowItWork;
                    $howitwork->key = 'work';
                    $howitwork->type = 'work_type';

                    $works = new Work;
                    $works->image = $filename;
                    $works->heading = $new_work_heading;
                    $works->description = $new_work_description;
                    $works->save();

                    $howitwork->work_id = $works->id;
                    $howitwork->save();
                }
            }

            $fields = [
                'title' => 'title',
                'main_heading' => 'main_heading',
                'short_description' => 'short_description',
                'join_our_community_text' => 'join_our_community',
                'second_banner_heading' => 'banner_heading',
                'second_banner_sub_heading' => 'sub_heading',
                'button_label' => 'button_label',
                'button_link' => 'button_link'
            ];
            
            foreach ($fields as $key => $input) {
                if ($request->has($input)) {
                    $How_it_work = HowItWork::where('key', $key)->first();
                    if ($How_it_work) {
                        $How_it_work->value = $request->$input;
                        $How_it_work->update();
                    }
                }
            }
            
            return redirect()->back()->with('success', 'Data successfully updated');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function deleteWorks(Request $request){
        if($request->action == 'update_work_sec'){
            $works = Work::find($request->id);
            $image_path = public_path('site_images/'.$works->image);
            if(File::exists($image_path)){
                unlink($image_path);
            }

            $works->delete();

            $howitwork = HowItWork::where('work_id',$request->id)->delete();

            $data = [
                'status' => 200,
                'success' => true
            ];
    
            return response()->json($data);
        }
    }

    
    public function termsConditions(){
        return view('admin.site_meta.terms_and_conditions.terms_and_conditions');
    }

    public function addTermsAndCondition(Request $request){
        return $request->all();
    }
}
