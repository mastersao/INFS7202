@foreach($posts as $post)

    <article>
        <a href="/forum/public/posts/{{ $post->title }}">
            <h1>{{ $post->title }}</h1>
        </a>
        <p>From: <a href="/forum/public/authors/{{ $post->author->name }}">{{ $post->author->name }}</a>
            Theme: <a href="/forum/public/categories/{{ $post->category->slug }}">
                {{ $post->category->name }}</a></p>
        <p>{{ $post->excerpt }}</p>
    </article>
@endforeach