<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
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
        $courses = Course::with(['category', 'modules.contents'])->get();

        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
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

                foreach ($moduleData['contents'] as $contentData) {
                    $contentImagePath = null;
                    if (isset($contentData['image'])) {
                        $contentImagePath = $contentData['image']->store('contents', 'public');
                    }
                    $module->contents()->create([
                        'text' => $contentData['text'],
                        'image' => $contentImagePath,
                        'video' => $contentData['video'],
                        'link' => $contentData['link']
                    ]);
                }
            }

            DB::commit();
            return response()->json(
                $course->load(['category', 'modules.contents'])
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
