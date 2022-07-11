<div>
    <div class="m-auto mt-5 block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <a href="javascript:void(0)" wire:click="back_to_post" class="mb-3 w-6/12 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">back to posts</a>
        <p><img src="{{ $post->image }}" alt="{{ $post->title }}"></p>
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
        <p>{{ $post->category->name }}</p>
        <p>{{ $post->user->name }}</p>
    </div>
</div>
