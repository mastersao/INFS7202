<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
</head>

<article class="flex bg-gray-200 border border-gray-200 rounded-9" style="margin-top: 50px">
    <div>
        <header>
            <div class="d-flex flex-wrap align-items-center">
                <div class="p-1">
                    <img class="rounded-circle" src="https://i.pravatar.cc/100" alt=""
                        style="width: 50px; height: 50px;">
                </div>
                <div class="p-1">
                    <h5>{{ $comment->user->name }}</h5>
                </div>
            </div>

            <p>published at <time>{{ $comment->created_at->diffForHumans() }}</time></p>
        </header>
        <p>{{ $comment->body }}</p>
    </div>
</article>
