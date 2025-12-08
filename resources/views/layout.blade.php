<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Viewer') }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="{{ route('tasks.index') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition">
                    {{ config('app.name', 'Task Viewer') }}
                </a>
                <nav>
                    <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-blue-600 font-medium px-3 py-2">Strona główna</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Task Viewer') }}. Autor: Paweł Pabło. Wszelkie prawa zastrzeżone.
            </div>
        </footer>
    </div>
</body>
</html>
