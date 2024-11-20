<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks;

    public function mount($id)
    {
        $this->tasks = Task::where('course_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.task-list');
    }

    public function deleteTask($id) 
    {
        $this->tasks = $this->tasks->where('id', '!=', $id);
        Task::where('id', $id)->delete();
    }
}
