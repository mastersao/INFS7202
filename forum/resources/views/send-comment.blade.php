<x-comment>
    <section class="col-span-8 mt-10">

        @foreach ($thread->comments as $comment)
        @include('components.comment', ['comment' => $comment])
        @endforeach


        <form method="POST" action="{{ route('comments.create', $thread) }}">
            @csrf

            <div>
                {{-- <label for="body"></label> --}}
                <textarea name="content" id="content" rows="4" placeholder="Write your comment here..."></textarea>
                @error('body')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit">发布</button>
            </div>
        </form>
    </section>
</x-comment>