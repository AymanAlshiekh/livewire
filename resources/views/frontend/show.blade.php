@component('layouts.app')
    @slot('slot')
        <div class="m-auto mt-5 block p-6 rounded-lg shadow-lg bg-white max-w-md">
            <p><img src="{{ $post->image }}" alt="{{ $post->title }}"></p>
            <p>{{ $post->title }}</p>
            <p>{{ $post->body }}</p>
            <p>{{ $post->category->name }}</p>
            <p>{{ $post->user->name }}</p>
        </div>
    @endslot
@endcomponent
