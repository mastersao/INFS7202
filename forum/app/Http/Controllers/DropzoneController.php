<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload; 
use Intervention\Image\ImageManagerStatic as Image;

class DropzoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function dropzone()
    {
        // return view('dropzone-view');
        $files = FileUpload::all();

        return view('dropzone-view', compact('files'));
    }
    
    
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().rand(1,100).'.'.$image->extension();
        $image->move(public_path('/images/'), $imageName);

        $imageUpload = new FileUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->address = '/images/' . $imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    public function refresh(Request $request)
    {
        // Log::info('Refresh called');
        $files = FileUpload::all();
        return view('dropzone-view', compact('files'));
    }

    public function addWatermark(Request $request)
    {
        $image = $request->file('file');

        $input['image'] = time() . '.' . $image->extension();

        // Get path of images folder from /public
        $imageFilePath = public_path('images');

        $img = Image::make($image->path());

        $img->text('By Online Web Tutor', 450, 100, function ($font) {
            // Using font family here
            $font->file(public_path('RobotoMono-VariableFont_wght.ttf'));
            $font->size(40);
            $font->color('#202124');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->save($imageFilePath . '/' . $input['image']);
    }

}
