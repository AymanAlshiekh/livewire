<div>
    <div class="container mx-auto px-4 flex flex-col">
        <br>
        this is dynamic components
        <a wire:click="create_post" href="javascript:void(0)"  class="w-2/12 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">create new post</a>
        @if ($showCreateForm)
            @livewire('daynamic-create')
        @endif
        @if ($showEditForm)
            @livewire('daynamic-edit')
        @endif
        @if ($showPost)
            @livewire('daynamic-show')
        @endif
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="border-b">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      image
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      title
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      owner
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      category
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        action
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <img width="150" height="150" src="{{ $post->image }}" alt="{{ $post->title }}">
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <a href="javascript:void(0)" wire:click="show_post({{ $post->id }})" >
                                {{ $post->title }}
                            </a>
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ $post->user->name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ $post->category->name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center mb-3">
                                <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
                                    <a href="javascript:void(0)" wire:click="edit_post({{ $post->id }})" type="button" class="rounded-l inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-0 active:bg-blue-800 transition duration-150 ease-in-out">edit</a>

                                    <a href="javascript:void(0)" wire:click="delete_post({{ $post->id }})" class="rounded-r inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 transition duration-150 ease-in-out">delete</a>
                                </div>
                            </div>

                        </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div>
                {{ $posts->links() }}
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
