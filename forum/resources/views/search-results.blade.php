<x-layout>
    @if (count($results) > 0)
    <h3>Search Results:</h3>
    <ul>
        @foreach ($results as $result)
            <li><a href="/forum/public/posts/{{ $result->title }}">{{ $result->title }}</a></li>
        @endforeach
    </ul>
    @else
        <p>No results found.</p>
    @endif


</x-layout>