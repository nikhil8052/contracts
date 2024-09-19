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
        try {
            $howitwork = HowItWork::where('status', 1)->first() ?? new HowItWork;

            if($request->action == 'update_work_sec'){
                $howitwork = HowItWork::where('status',1)->first();
                $works_data = json_decode($howitwork->works);
                $new_array = [];
                foreach($works_data as $key => $value){
                    if($key == $request->key){
                        continue;
                    }
                    array_push($new_array,$value);
                }
                $howitwork->works = json_encode($new_array);
                $howitwork->update();

                return response()->json('done');
            }

            if (isset($request->title) && $request->title != null) {
                $howitwork->title = $request->title;
                $howitwork->slug = $request->slug;
            }
    
            if ($request->hasFile('append_template_image')) {
                $templatData = [];
                for ($i = 0; $i < count($request->append_template_image); $i++) {
                    $file = $request->file('append_template_image')[$i];
                    $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('site_images'), $filename);
    
                    $template_heading = $request->template_heading[$i];
                    $template_subheading = $request->templatesubheading[$i];
    
                    $template_data = [
                        'image' => $filename, 
                        'heading' => $template_heading, 
                        'subheading' => $template_subheading
                    ];
                    array_push($templatData, $template_data);
                }
                $howitwork->template_section = json_encode($templatData);
            }
    
            if ($request->hasFile('template_image')) {
                $template_image = $request->file('template_image');
                $template_filename = 'SiteImages' . time() . rand(1, 100) . '.' . $template_image->extension();
                $template_image->move(public_path('site_images'), $template_filename);
    
                $howitwork->template_section_image = $template_filename;
            }
    
            if(isset($request->main_heading) && $request->main_heading != null){
                $howitwork->second_main_heading = $request->main_heading;
            }
    
            if(isset($request->short_description) && $request->short_description != null){
                $howitwork->second_short_description = $request->short_description;
            }
    
            if($request->hasFile('work_image')){
                $workData = [];
                for ($i = 0; $i < count($request->work_image); $i++) {
                    $file = $request->file('work_image')[$i];
                    $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('site_images'), $filename);
    
                    $work_heading = $request->work_heading[$i];
                    $work_description = $request->work_description[$i];

                    $work_data = [
                        'image' => $filename, 
                        'heading' => $work_heading, 
                        'description' => $work_description
                    ];
                    array_push($workData, $work_data);

                    $howitwork->works = json_encode($workData);
                    $howitwork->save();
                }
        
            } else {
                $worksectionData = json_decode($howitwork->works);
                $existing_images = [];
                $new_work_data = [];

                foreach ($worksectionData as $key => $value) {
                    $old_image = $value->image;
                    array_push($existing_images, $old_image);
                }

                $workHeading = $request->work_heading;
                for ($i = 0; $i < count($workHeading); $i++) {
                    $new_workData = [
                        'image' => $existing_images[$i], 
                        'heading' => $workHeading[$i], 
                        'description' => $request->work_description[$i]
                    ];
                    array_push($new_work_data, $new_workData);

                    $howitwork->works = json_encode($new_work_data);
                    $howitwork->update();
                }
               
            }
    
            if(isset($request->join_our_community) && $request->join_our_community != null){
                $howitwork->join_our_community_text = $request->join_our_community;
            }
    
            if(isset($request->banner_heading) && $request->banner_heading != null){
                $howitwork->banner_heading = $request->banner_heading;
            }
    
            if (isset($request->sub_heading) && $request->sub_heading != null) {
                $howitwork->banner_sub_heading = $request->sub_heading;
            }
    
            if(isset($request->button_label) && $request->button_label != null){
                $howitwork->banner_button_label = $request->button_label;
            }
    
            if(isset($request->button_link) && $request->button_link != null){
                $howitwork->banner_button_link = $request->button_link;
            }
    
            $howitwork->save();
    
            return redirect()->back()->with('success', 'Data successfully updated');
        } catch (Exception $e) {
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    
}
