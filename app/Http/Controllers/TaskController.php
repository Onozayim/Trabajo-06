<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //
    public function index($id)
    {
        $course = null;

        if (auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $id)
                ->where('teacher', auth()->id())
                ->first();
        }

        if (!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');

        return view('tasks.create', compact('course'));
    }

    public function edit_view($id) {
        $task = Task::where('id', $id)->first();

        $course = null;

        if (auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $task->course_id)
                ->where('teacher', auth()->id())
                ->first();
        }

        if (!$course)
            return redirect('/dashboard')->with('error', 'Course not found!');

        return view('tasks.edit', compact('task', 'course'));
    }

    public function save(Request $request)
    {
        Validator::make($request->only('title', 'description', 'due_date'), [
            'title' => ['required', 'string', 'min:1', 'max:50'],
            'description' => ['required', 'string', 'min:1', 'max:100'],
            'due_date' => ['required', 'date', 'after:today'],
        ])->validate();


        $course = null;

        if (auth()->user()->rol == 'teacher') {
            $course = Course::where('id', $request->id)
                ->where('teacher', auth()->id())
                ->first();
        }

        if (!$course)
            return redirect("/course/$request->id")->with('error', 'Course not found!');

        Task::create([
            'course_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect("/course/$request->id")->with('status', 'Task saved!');
    }

    public function update(Request $request) {
        Validator::make($request->only('title', 'description', 'due_date'), [
            'title' => ['required', 'string', 'min:1', 'max:50'],
            'description' => ['required', 'string', 'min:1', 'max:100'],
            'due_date' => ['required', 'date', 'after:today'],
        ])->validate();

        $task = Task::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date
            ]);

        return redirect("/course/$request->course_id")->with('error', 'Task updated!');
    }
}
