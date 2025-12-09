@extends('layout')

@section('content')
<div class="space-y-8">
    <!-- Back to Categories -->
    <div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Wróć do kategorii
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ isset($selectedCategory) ? route('category.show', $selectedCategory) : route('tasks.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow">
                <label for="query" class="sr-only">Szukaj</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="query" id="query" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                           placeholder="Szukaj zadań (nazwa, opis, numer)..." 
                           value="{{ request('query') }}">
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Szukaj
            </button>
            @if(request('query'))
                <a href="{{ isset($selectedCategory) ? route('category.show', $selectedCategory) : route('tasks.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Wyczyść
                </a>
            @endif
        </form>
    </div>

    <!-- Task List -->
    <div class="space-y-12">
        @forelse ($categories as $categoryName => $tasks)
            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <span class="capitalize">{{ $categoryName }}</span>
                    <span class="ml-3 text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ count($tasks) }} zadań</span>
                </h2>
                
                <div class="space-y-3">
                    @foreach ($tasks as $task)
                        <a href="{{ route('tasks.show', ['category' => $categoryName, 'task' => $task['slug']]) }}" 
                           class="group block bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition duration-200 overflow-hidden">
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div class="flex-grow pr-4">
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">
                                            <span class="text-gray-400 font-mono text-sm mr-1">#{{ $task['slug'] }}</span>
                                            {{ $task['title'] }}
                                        </h3>
                                        @if(isset($task['priority']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                {{ $task['priority'] == 'high' ? 'bg-red-100 text-red-800' : 
                                                   ($task['priority'] == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($task['priority']) }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 line-clamp-1">
                                        {{ $task['description'] ?? 'Brak opisu.' }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-4 flex-shrink-0">
                                    <span class="text-sm text-gray-500 hidden sm:block">
                                        {{ $task['status'] ?? 'Szkic' }}
                                    </span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="text-center py-20 bg-white rounded-xl border border-gray-100 border-dashed">
                <div class="mx-auto h-12 w-12 text-gray-400">
                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nie znaleziono zadań</h3>
                <p class="mt-1 text-sm text-gray-500">
                    W tej kategorii nie ma jeszcze zadań lub nie pasują do kryteriów wyszukiwania.
                </p>
                @if(request('query'))
                    <div class="mt-6">
                        <a href="{{ isset($selectedCategory) ? route('category.show', $selectedCategory) : route('tasks.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Wyczyść filtry
                        </a>
                    </div>
                @endif
            </div>
        @endforelse
    </div>
</div>
@endsection
