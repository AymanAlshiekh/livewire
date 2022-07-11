<div>
    <div class="m-auto mt-5 block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <a href="javascript:void(0)" wire:click="back_to_post" class="mb-3 w-6/12 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">back to posts</a>
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="form-group mb-6">
                <input
                type="text" name="title" wire:model="title" class="form-control block
                {{ $errors->has('title') ? 'border-red-500' : '' }}
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput7"
                placeholder="title">
                @error('title')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-6">
                <select name="category_id" wire:model="category_id" class="form-select appearance-none
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding bg-no-repeat
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                  <option value="">select post category</option>
                  @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group mb-6">
                <textarea
                name="body"
                class="
                form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                "
                id="exampleFormControlTextarea13"
                rows="3"
                placeholder="post body"
                wire:model="body"
            ></textarea>
            @error('body')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
            </div>
            <div class="form-group mb-6">
                <div class="mb-3">
                    <img class="mb-3" src="{{ $post->image }}" alt="{{ $this->title }}" width="150" height="10">
                  <input
                  wire:model="image"
                  placeholder="image"
                  class="form-control
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" name="image" id="formFile">
                </div>
                @error('image')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
              </div>
            <button type="submit" class="
                w-full
                px-6
                py-2.5
                bg-blue-600
                text-white
                font-medium
                text-xs
                leading-tight
                uppercase
                rounded
                shadow-md
                hover:bg-blue-700 hover:shadow-lg
                focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                active:bg-blue-800 active:shadow-lg
                transition
                duration-150
                ease-in-out">Send</button>
            </form>
  </div>
</div>
