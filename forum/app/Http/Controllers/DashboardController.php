<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watermark;
use Intervention\Image\ImageManagerStatic as Image;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show(Request $request)
    {
        $user = Auth::user();
        return view('dashboard', ['user' => $user]);
    }

    public function imageUpload()
    {
        // $images = Watermark::latest();
        // return view('add-watermark', compact('images'));
        return view('add-watermark');
    }

    public function addWatermark(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:4096',
        ]);

        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $imgFile = Image::make($image->getRealPath());
        // $watermark = public_path('/images/watermark.png');

        $imgFile->text('© INFS7202 Chengyang', 450, 150, function($font) { 
            $font->file(public_path('/fonts/Pacifico-Regular.ttf'));
            $font->size(40);  
            $font->color('#ffffff');  
            $font->align('center');  
            $font->valign('bottom');  
        })->save(public_path('/uploads').'/'.$input['file']);        
        
        // $imgFile->insert($watermark, 'center', 10, 10);

        return back()
        	->with('success','File uploaded successfully ')
        	->with('fileName',$input['file']);         
    }
}
