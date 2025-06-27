<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('id', 'asc')->get();
        

        return TodoResource::collection($todos);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'status' => 'required|in:in progress,completed,canceled'
        ]);

        $todo = Todo::create($request->all());
        $todo->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Todo created successfully',
            'data' => $todo,
        ]);
    }

    public function show($id){
        $todo = Todo::findorFail($id);
         
        return new TodoResource($todo);
    }
    public function update($id, Request $request){

        $request->validate([
            'name' => 'required', 
            'category_id' => 'required'
        ]);

        $todo = Todo::findorFail($id);
            $todo->name = $request->name;
            $todo->category_id = $request->category_id;
        $todo->save();

        return response()->json([
            'success' => true,
            'message' => 'Todo updated successfully',
            'data' => $todo
        ]);
    }

    public function destroy($id){
        $todo = Todo::findorFail($id);
        $todo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Todo deleted successfully',
            'data' => $todo
        ]);
    }
}
