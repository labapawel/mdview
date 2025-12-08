@extends('layout')

@section('content')
<div class="w-full mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm text-gray-500">
        <a href="{{ route('tasks.index') }}" class="hover:text-blue-600 transition">Zadania</a>
        <span class="mx-2">/</span>
        <span class="capitalize">{{ $task['category'] }}</span>
        <span class="mx-2">/</span>
        <span class="text-gray-900 font-medium">{{ $task['title'] }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="border-b border-gray-100 bg-gray-50/50 px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $task['title'] }}</h1>
                        <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                {{ ucfirst($task['category']) }}
                            </span>
                            
                            @if(count($files) > 0)
                                <div class="flex items-center gap-2 ml-2 border-l border-gray-300 pl-3">
                                    @foreach($files as $file)
                                        <a href="{{ route('tasks.download', ['category' => $task['category'], 'task' => $task['slug'], 'file' => $file]) }}" 
                                           title="Pobierz {{ $file }}"
                                           class="text-gray-400 hover:text-blue-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @if(isset($task['meta']['created_at']))
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $task['meta']['created_at'] }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border
                            {{ ($task['meta']['priority'] ?? '') == 'high' ? 'bg-red-50 text-red-700 border-red-100' : 
                               (($task['meta']['priority'] ?? '') == 'medium' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 'bg-green-50 text-green-700 border-green-100') }}">
                            Priorytet: {{ ucfirst($task['meta']['priority'] ?? 'Normalny') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border bg-gray-100 text-gray-700 border-gray-200">
                            {{ ucfirst($task['meta']['status'] ?? 'Szkic') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8">
                <div class="prose prose-blue max-w-none prose-img:rounded-xl prose-headings:font-semibold text-gray-800">
                    {!! $task['content'] !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
