<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use Exception;

class SiteMetaController extends Controller
{
    public function howItWorks(){
        $howitwork = HowItWork::first();
        return view('admin.site_meta.howItWorks.add_how_it_work',compact('howitwork'));
    }

    public function addHowItWorks(Request $request){
        try{
            $howitwork = new HowItWork;
            if(isset($request->title) && $request->title != null){
                $howitwork->title = $request->title;
                $howitwork->slug = $request->slug;
            }

            if($request->hasFile('append_template_image')){
                for($i=0; $i<count($request->append_template_image); $i++){
                    $file = $request->file('append_template_image')[$i];
                    $filename = 'HowItWork'.time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('site_images'),$filename);

                    $template_heading = $request->template_heading[$i];
                    $template_subheading = $request->templatesubheading[$i];

                    $template_data = ['image'=>$filename, 'heading'=>$template_heading, 'subheading'=>$template_subheading];

                    $howitwork->template_section = json_encode($template_data);
                }
            }

            if($request->hasFile('template_image')){
                $template_image = $request->file('template_image');
                $template_filename = 'HowItWork'.time().rand(1,100).'.'.$template_image->extension();
                $template_image->move(public_path('site_images'),$template_filename);

                $howitwork->template_section_image = $template_filename;
            }

            if(isset($request->main_heading) && $request->main_heading != null){
                $howitwork->second_main_heading = $request->main_heading;
            }

            if(isset($request->short_description) && $request->short_description != null){
                $howitwork->second_short_description = $request->short_description;
            }

            if($request->hasFile('work_image')){
                for($i=0; $i<count($request->work_image); $i++){
                    $file = $request->file('work_image')[$i];
                    $filename = 'HowItWork'.time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('site_images'),$filename);

                    $work_heading = $request->work_heading[$i];
                    $work_description = $request->work_description[$i];

                    $work_data = ['image'=>$filename, 'heading'=>$work_heading, 'description'=>$work_description];

                    $howitwork->works = json_encode($work_data);
                }
            }

            if(isset($request->join_our_community) && $request->join_our_community != null){
                $howitwork->join_our_community_text = $request->join_our_community;
            }

            if(isset($request->banner_heading) && $request->banner_heading != null){
                $howitwork->banner_heading = $request->banner_heading;
            }

            if(isset($request->sub_heading) && $request->sub_heading != null){
                $howitwork->banner_sub_heading = $request->banner_sub_heading;
            }

            if(isset($request->button_label) && $request->button_label != null){
                $howitwork->banner_button_label = $request->button_label;
            }

            if(isset($request->button_link) && $request->button_link != null){
                $howitwork->banner_button_link = $request->button_link;
            }

            $howitwork->save();

            return redirect()->back()->with('success', 'Data successfully added');
        }catch(Exception $e){
            saveLog("Error:","SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }

    }
}
