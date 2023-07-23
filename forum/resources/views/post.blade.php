<x-layout>
    <article>
        <h1>{{ $post->title }}</h1>
        <p>From: <a href="/forum/public/authors/{{ $post->author->name }}">{{ $post->author->name }}</a>
            Theme: <a href="/forum/public/categories/{{ $post->category->slug }}">

                {{ $post->category->name }}</a></p>

        {!! $post->body !!}
    </article>
    <div class="list-group">
        <br>
        <br>
        <div class="row">

            <button class="btn btn-outline-danger thumb-up">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart"
                    viewBox="0 0 16 16">
                    <path
                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                </svg>
                LIKE
            </button>

        </div>

        <br>
        <br>
        
        <a href="/forum/public/">Return</a>

    </div>
    <section class="col-span-8 mt-10">
        {{-- <article class="flex bg-gray-200 border border-gray-200 rounded-9" style="margin-top: 50px">
            <div>
                <header>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="p-1">
                            <img class="rounded-circle" src="https://i.pravatar.cc/100" alt=""
                                style="width: 50px; height: 50px;">
                        </div>
                        <div class="p-1">
                            <h5>user names</h5>
                        </div>
                    </div>

                    <p>published at <time>3 seconds ago</time></p>
                </header>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima amet reiciendis natus dolorum
                    doloribus blanditiis voluptatum laudantium, architecto exercitationem et!</p>
            </div> --}}
        {{-- </article> --}}
</x-layout>