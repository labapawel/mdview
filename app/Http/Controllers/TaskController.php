<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    private $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/private');
    }

    public function index(Request $request)
    {
        $categories = [];
        $query = $request->input('query');
        $selectedCategory = $request->input('category');

        if (!File::exists($this->storagePath)) {
            return view('tasks.index', ['categories' => [], 'filters' => ['query' => $query, 'category' => $selectedCategory]]);
        }

        $allCategoryDirs = File::directories($this->storagePath);
        $availableCategories = array_map(fn($path) => basename($path), $allCategoryDirs);

        foreach ($allCategoryDirs as $categoryDir) {
            $categoryName = basename($categoryDir);

            // Filter by Category
            if ($selectedCategory && $selectedCategory !== $categoryName) {
                continue;
            }

            $tasks = [];
            $taskDirs = File::directories($categoryDir);
            
            foreach ($taskDirs as $taskDir) {
                $taskDirName = basename($taskDir);
                $jsonPath = $taskDir . '/zadanie.json';
                
                $taskData = [
                    'slug' => $taskDirName,
                    'title' => $taskDirName,
                    'description' => '',
                    'priority' => 'unknown',
                    'status' => 'unknown',
                    'meta' => []
                ];

                if (File::exists($jsonPath)) {
                    $jsonContent = json_decode(File::get($jsonPath), true);
                    $taskData = [
                        'slug' => $taskDirName,
                        'title' => $jsonContent['title'] ?? $taskDirName,
                        'description' => $jsonContent['description'] ?? '',
                        'priority' => $jsonContent['priority'] ?? 'medium',
                        'status' => $jsonContent['status'] ?? 'pending',
                        'meta' => $jsonContent
                    ];
                }

                // Filter by Search Query
                if ($query) {
                    $searchable = strtolower($taskData['title'] . ' ' . $taskData['description']);
                    if (!str_contains($searchable, strtolower($query))) {
                        continue;
                    }
                }

                $tasks[] = $taskData;
            }

            if (!empty($tasks)) {
                $categories[$categoryName] = $tasks;
            }
        }

        return view('tasks.index', compact('categories', 'availableCategories'));
    }

    public function show($category, $taskSlug)
    {
        $path = $this->storagePath . '/' . $category . '/' . $taskSlug;
        
        if (!File::exists($path)) {
            abort(404, 'Task not found');
        }

        $jsonPath = $path . '/zadanie.json';
        $mdPath = $path . '/zadanie.md';

        $task = [
            'category' => $category,
            'slug' => $taskSlug,
            'title' => $taskSlug,
            'meta' => [],
            'content' => ''
        ];

        if (File::exists($jsonPath)) {
            $task['meta'] = json_decode(File::get($jsonPath), true);
            $task['title'] = $task['meta']['title'] ?? $taskSlug;
        }

        if (File::exists($mdPath)) {
            $task['content'] = Str::markdown(File::get($mdPath));
        } else {
            $task['content'] = '<p>Brak opisu.</p>';
        }

        $files = [];
        $allFiles = File::files($path);
        foreach ($allFiles as $file) {
            if ($file->getExtension() === 'zip') {
                $files[] = $file->getFilename();
            }
        }

        return view('tasks.show', compact('task', 'files'));
    }

    public function download($category, $taskSlug, $filename)
    {
        $path = $this->storagePath . '/' . $category . '/' . $taskSlug . '/' . $filename;

        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        while (ob_get_level()) {
            ob_end_clean();
        }

        return response()->download($path, $filename, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
