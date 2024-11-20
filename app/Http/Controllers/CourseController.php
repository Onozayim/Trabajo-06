<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Member;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //

    public function index($id) {
        $course = null;

        if(auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $id)
                ->where('teacher', auth()->id())
                ->first();
        }else {
            $course_id = Member::where('user_id', auth()->id())
                ->where('course_id', $id)
                ->first()->id ?? null;
            $course = Course::where('id', $course_id)
                ->first();
        }
            
        if(!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');
    

        return view('courses.index', compact('course'));
    }

    public function members($id) {
        $course = null;

        if(auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $id)
                ->where('teacher', auth()->id())
                ->first();
        }
            
        if(!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');

        return view('courses.members', compact('course'));
    }

    public function save(Request $request) {
        Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:1', 'max:50'],
            'description' => ['required', 'string', 'min:1', 'max:100'],
        ])->validate();

        Course::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'teacher' => auth()->id()
        ]);

        return redirect('/dashboard')->with('status', 'Course saved!');
    }

    public function edit_view($id) {
        $course = null;

        if(auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $id)
                ->where('teacher', auth()->id())
                ->first();
        }
            
        if(!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request) {
        $course = null;

        if(auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $request->id)
                ->where('teacher', auth()->id())
                ->first();
        }
            
        if(!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');

        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();

        return redirect("course/$request->id")->with('status', 'Course updated!');
    }
}
