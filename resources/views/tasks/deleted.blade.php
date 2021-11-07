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
                    <a href="{{ route('tasks.index') }}">
                        <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-green-600 rounded">
                            Back
                        </div>
                    </a>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($tasks as $task)
                        <div class="font-sans flex items-center justify-center bg-white-darker w-full py-4">
                            <div class="overflow-hidden bg-blue-50 rounded max-w-xs w-full shadow-lg  leading-normal">
                                @if($task->completed_at)
                                    <div class="bg-green-400 shadow-lg leading-normal overflow-hidden">
                                        <s>
                                            @endif
                                            <p class="font-bold text-lg mb-1 text-black group-hover:text-white m-2">{{ $task->title }}</p>
                                            <p class="text-grey-darker mb-2 group-hover:text-white m-2">{{ $task->content }}</p>
                                            @if($task->completed_at)
                                        </s>
                                        @if($task->completed_at)
                                            <p class="font-bold text-sm">Completed: {{$task->completed_at}}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="buttons flex">
                                <form method="post" action="{{ route('tasks.restore', $task->id) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" onclick="return confirm('Are you sure you want to restore?')">
                                        <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-green-500 rounded">
                                            Restore
                                        </div>
                                    </button>
                                </form>

                                <form method="post" action="{{ route('tasks.forceDelete', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete?')">
                                        <div class="btn p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-red-500 rounded">
                                            Delete
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
