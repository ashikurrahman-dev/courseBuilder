<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['category', 'modules.contents'])->latest()->get();

        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $attributes = $request->validated();
            $attributes['slug'] = str::slug($request->validated('title'), '-');
            if ($request->hasFile('image')) {
                $attributes['image'] = $request->file('image')->store('courses', 'public');
            }
            $course = Course::create($attributes);

            foreach ($request->modules as $moduleData) {
                $module = $course->modules()->create([
                    'title' => $moduleData['title']
                ]);

                // dd($moduleData['contents']);
                foreach ($moduleData['contents'] as $contentData) {
                    $contentImagePath = null;
                    if (isset($contentData['image'])) {
                        $contentImagePath = $contentData['image']->store('contents', 'public');
                    }
                    $module->contents()->create([
                        'text' => $contentData['text'] ?? null,
                        'image' => $contentImagePath ?? null,
                        'video' => $contentData['video'] ?? null,
                        'link' => $contentData['link'] ?? null
                    ]);
                }
            }

            DB::commit();
           return redirect()->route('courses.index')->with('success', 'Course created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating course: ' . $e->getMessage())->withInput();
        }
    }
}
