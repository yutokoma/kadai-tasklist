<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;
use App\User;

class TasksController extends Controller
{
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();

            $tasks = $user->tasks()->orderBy('created_at', 'asc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            
            $data += $this->counts($user);

            return view('tasks.index', $data);
        }
        else {
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
        // var_dump($request->status);
        // exit;
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);

        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content
        ]);

        return redirect('/');
    }

    
    public function show($id)
    {
        $task = Task::find($id);
        
    if (\Auth::user()->id === $task->user_id){
        return view('tasks.show', [
            'task' => $task,
        ]);}
        return redirect('/');
       
       // return view('tasks.show', $data);
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
         $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            $task->delete();
        }

        return redirect('/');
    }
    
}



















