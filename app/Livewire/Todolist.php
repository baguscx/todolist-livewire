<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Todolist extends Component
{
    public $title = '';
    public $id_todo = 0;
    public $isEdit = false;

    public function save() {
        if($this->id_todo != 0){
            $todo = Todo::find($this->id_todo);
            $todo->update([
                'title' => $this->title
            ]);
            $this->isEdit = false;
        } else {
            Todo::create([
                'title' => $this->title
            ]);
        }

        $this->reset();
    }

    public function edit($id) {
        $todo = Todo::find($id);
        $this->id_todo = $todo->id;
        $this->title = $todo->title;
        $this->isEdit = true;


    }

    public function render()
    {
        $todos = Todo::orderBy('id', 'desc')->get();
        return view('livewire.todolist', [
            'todos' => $todos
        ]);
    }

    public function delete($id) {
        Todo::find($id)->delete();
    }
}
