<div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
    <label for="title" class="text-grey-darker font-bold">Title</label>
    <input id="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" type="text"
           name="title" value="{{ old('title', $task->title ?? '') }}">
    @error('title')
        <p class="text-red-600">{{ $message }}</p>
    @enderror

    <label for="content" class="text-grey-darker font-bold">Content</label>
    <textarea id="content" class="content bg-gray-100 sec p-3 h-30 border border-gray-300 outline-none"
              name="content">{{ old('content', $task->content ?? '') }}</textarea>
    @error('content')
    <p class="text-red-600">{{ $message }}</p>
    @enderror

    <label for="status" class="text-grey-darker font-bold">Status</label>
    <input id="status" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" type="text"
           name="status" value="{{ old('status', $task->status ?? '') }}">
    @error('status')
    <p class="text-red-600">{{ $message }}</p>
    @enderror

    <div class="buttons flex mt-5">
        <button>
            <div class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">
                {{ $task->exists ? "Save" : "Create" }}
            </div>
        </button>
    </div>
</div>

