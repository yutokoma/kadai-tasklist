<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

class TasksController extends Controller
{
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            $data += $this->counts($user);
            return view('tasks.show', $data);
        }else {
            return view('welcome');
        }
    }

    
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->tasks()->create([
            'content' => $request->content,
        ]);

        return redirect('/');
    }

    
    public function show($id)
    {
        $task = Task::find($id);
        $tasks = $task->tasks()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'tasks' => $tasks,
        ];

        $data += $this->counts($user);

        return view('tasks.show', $data);
    }

    
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
            'status' => 'required|max:10', 
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status; 
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    
    public function destroy($id)
    {
         $task = \App\Task::find($id);

        if (\Auth::user()->id === $task->user_id) {
            $task->delete();
        }

        return redirect()->back();
    }
}



















