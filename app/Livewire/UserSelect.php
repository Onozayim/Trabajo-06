<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserSelect extends Component
{
    public $users;
    public $selected;
    public $selected_ids;
    public $username = "";
    public $id;
    public $disabled;

    public function mount($id)
    {
        $this->users = [];
        $members_ids = Member::where('course_id', $id)->get()->pluck('user_id')->toArray();
        $this->selected_ids = $members_ids;
        $this->selected = User::whereIn('id', $members_ids)->get()->toArray();
        $this->id = $id;
        
        $this->disabled = count($this->selected_ids) == 0;
    }

    public function render()
    {
        return view('livewire.user-select');
    }

    public function updatedUsername($value)
    {
        if($value == "") {
            $this->users = [];
            return;
        }

        $this->users = User::select('id', 'name')
            ->where('rol', 'student')
            ->whereNotIn('id', $this->selected_ids)
            ->where('name', 'like', '%' . $value . '%')->get()->toArray();
    }

    public function addUser($user)
    {
        $this->selected[] = $user;
        $this->selected_ids[] = $user['id'];
        $this->users = array_filter($this->users, function($u) use($user) {
            return $u['id'] != $user['id'];
        });

        $this->disabled = false;
    }

    public function removeUser($user)
    {
        $this->selected = array_filter($this->selected, function($u) use($user ) {
            return $user['id'] != $u['id'];
        });

        $this->selected_ids = array_filter($this->selected_ids, function($id) use($user) {
            return $id != $user['id'];
        });

        $this->disabled = count($this->selected_ids) == 0;

        if(str_contains($user['name'], $this->username) && $this->username != "") {
            $this->users[] = $user;
        }
    }

    public function save() {
        if(count($this->selected) == 0) return;

        Member::where('course_id', $this->id)->delete();

        foreach($this->selected as $user) {
            Member::create([
                'user_id' => $user['id'],
                'course_id' => $this->id
            ]);
        }

        return redirect("course/$this->id")->with('status', 'Members Saved!');
    }
}
