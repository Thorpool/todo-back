<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index() {
        return Todo::all();
    }

    public function destroy(int $todo) {
        $todo = Todo::find($todo);
        $todo->delete();
    }

    public function update( Request $request, int $todo){
        $this->validate($request,
            [
                'checked' => 'boolean',
                'message' => 'string'
            ]
        );

        Todo::Where('id', $todo)->update($request->only(['checked', 'message']));
    }

    public function store(Request $request) {
        $this->validate($request,
            [
                'message' => 'required|string'
            ]
        );

        Todo::create(['message' => $request->get('message')]);
    }
}
