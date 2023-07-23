<x-layout>
    {{-- <div id="post-data"> --}}
    <div id="data-wrapper">
        {{-- @foreach($posts as $post)

        <article>
            <a href="/forum/public/posts/{{ $post->title }}">
                <h1>{{ $post->title }}</h1>
            </a>
            <p>From: <a href="/forum/public/authors/{{ $post->author->name }}">{{ $post->author->name }}</a>
                Theme: <a href="/forum/public/categories/{{ $post->category->slug }}">
                    {{ $post->category->name }}</a></p>
            <p>{{ $post->excerpt }}</p>
        </article>
        @endforeach --}}
        @include('data')
    </div>
    <div class="auto-load text-center" style="display: none;">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                {{-- <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                    from="0 50 50" to="360 50 50" repeatCount="indefinite" /> --}}
            </path>
        </svg>
    </div>

    <script>
        var ENDPOINT = "https://infs3202-9a93dc29.uqcloud.net/forum/public/";
        // var ENDPOINT = "{{ route('/') }}";
        var page = 1;
    
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function () {
                        $('.auto-load').show();
                    }
                })
                .done(function (response) {
                    if (response.html == '') {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>


</x-layout>