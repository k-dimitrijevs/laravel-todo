<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="buttons flex m-5">
                    <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-green-600">
                        <a href="{{ route('tasks.create') }}">Create new task</a>
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($tasks as $task)
                        <div class="font-sans flex items-center justify-center bg-white-darker w-full py-8">
                            <div class="overflow-hidden bg-blue-50 rounded max-w-xs w-full shadow-lg  leading-normal">
                                <p class="font-bold text-lg mb-1 text-black group-hover:text-white m-2">{{ $task->title }}</p>
                                <p class="text-grey-darker mb-2 group-hover:text-white m-2">{{ $task->content }}</p>
                            </div>

                            <div class="buttons flex">
                                <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-yellow-500">
                                    <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                                </div>
                                <form method="post" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-red-500">
                                        <button type="submit" onclick="confirm('Are you sure you want to delete?')">Delete</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>