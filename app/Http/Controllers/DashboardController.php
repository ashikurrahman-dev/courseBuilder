<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $category = Category::count();
        $course = Course::count();
        $content = Content::count();

        return view('dashboard', compact(['category', 'course', 'content']));
    }
}
