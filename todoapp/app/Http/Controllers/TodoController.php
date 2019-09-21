<?php
namespace App\Http\Controllers;

use App\todo;
use Illuminate\Http\Request;

class TodoController extends Controller {
    public function index() {
        $todos = todo::all();
        return view('todo',compact('todos'));
    }
    public function create() {

    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required'
        ]);
        $todo = todo::create([
            'name' => request('name'),
        ]);
        return redirect('/todo');
    }
    public function destroy( todo $todo) {
        Project::findOrFail($todo)->delete();

        return redirect('/todo');
    }
}
