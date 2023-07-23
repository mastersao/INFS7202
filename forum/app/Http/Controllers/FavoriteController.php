<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function thumbUp($id)
    {
        // $request->likes()->create(['user_id' => auth()->id()]);
        // return back();
        // $like = Favorite::where('post_id',)
        $post = Post::findOrFail($id);
        $post->thumb_ups++;
        $post->save();
        // return response()->json(['success' => true]);
        ddd($post->thumb_ups);
    }


}
