<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;


class GoogleOCRController extends Controller
{
    public function index()
    {
        return view('googleOcr');
    }

    public function submit(Request $request)
    {
        if($request->file('image')) {

            // convert to base64
            $image = base64_encode(file_get_contents($request->file('image')));

            $client = new ImageAnnotatorClient();
            $client->setImage($image);
            $client->setFeature("TEXT_DETECTION");

            $google_request = new GoogleCloudVision([$client],  env('GOOGLE_KEY'));

            $response = $google_request->annotate();

            // dd($response);
        }
    }
}
