<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        $search_query = $request->input('search_query');
        if (!empty($search_query)) {
            $results = Post::where('title', 'like', '%' . $search_query . '%')
                ->orWhere('body', 'like', '%' . $search_query . '%')
                ->get();
        }
        else {
            $results = collect();
        }
        return view('search-results', ['results' => $results]);
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::select("title")
                ->where("title", "like", "%" . $query . "%")
                ->get();
        $response = array();
        foreach($posts as $post) {
            $response[] = $post->title;
        }
        return response()->json($response);
    }

    public function results()
    {
        return view('search-results');
    }


    public function index(Request $request)
    {
        // $posts = Post::latest()->get();
        // return view('posts', compact('posts'));
        // $posts = Post::with('author', 'category')->paginate(10);
        // $lastPage = $posts->lastPage();

        // return view('posts', compact('posts', 'lastPage'));


        // $posts = Post::latest()->paginate(5);
        // if ($request->ajax()) {
        //     return response()->json([
        //         'view' => view('posts', ['posts' => $posts])->render(),
        //         'nextPageUrl' => $posts->nextPageUrl(),
        //     ]);
        // }
        // return view('posts', compact('posts'));

        $posts = Post::paginate(5);
  
        if ($request->ajax()) {
            $view = view('data', compact('posts'))->render();
  
            return response()->json(['html' => $view]);
        }
  
        return view('posts', compact('posts'));

    }


}
