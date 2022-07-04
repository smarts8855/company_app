<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
   public function HomeSlider(){
       $sliders = Slider::latest()->get();
       return view('admin.slider.index',compact('sliders'));
   } //End Method

   public function AddSlider(){
       return view('admin.slider.create');
   } // End Method

   public function StoreSlider(Request $request){

    $slider_image = $request->file('image');
    // $name_gen = hexdec(uniqid());
    // $img_ext = strtolower($brand_image->getClientOriginalExtension());
    // $img_name = $name_gen.'.'.$img_ext;
    // $up_location = 'image/brand/';
    // $last_img = $up_location.$img_name;
    // $brand_image->move($up_location,$img_name);

    $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
    Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

    $last_img = 'image/slider/'.$name_gen;

    Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_img,
        'created_at' => Carbon::now()
    ]);

    return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
   } // End Method

   public function Edit($id){

    $sliders = Slider::find($id);
    return view('admin.slider.edit',compact('sliders'));

   } // End Method

   public function Update(Request $request, $id){
    $validated = $request->validate([
        'title' => 'required|unique:sliders|min:4',            
                    
    ],
    [
        'title.required' => 'Please Input Title',            
        'title.min' => ' Title Must Not Less Than 4 Characters ',
                    
    ]);
    $old_image = $request->old_image;
    $slider_image = $request->file('image');
    if($slider_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($slider_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$img_name;
        $slider_image->move($up_location,$img_name);
        unlink($old_image);

        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
    }else{
        Slider::find($id)->update([
            'title' => $request->title,                
            'description' => $request->description,                
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
    }
    
} // End Method

    public function Delete($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);
    Slider::find($id)->delete();
    return Redirect()->back()->with('success', 'Slider Delete  Successfully');

    }// End Method

    

}
