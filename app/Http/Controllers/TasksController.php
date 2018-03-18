<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
    //$task = Task::find($id);
    $data = [];
        //if (\Auth::check()) {
        //if (\Auth::user()->id === $task->user_id) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        //}
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
            //'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' =>$request->status,
        ]);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   /*$task = Task::find($id);
    
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'tasks' => $tasks,
        ];
        
        //$data += $this->counts($user);
        }*/
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            $user = \Auth::user();
        
        return view('tasks.show', [
            'task' => $task,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            $user = \Auth::user();

        return view('tasks.edit', [
            'task' => $task,
        ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
        $this->validate($request, [
            'status' => 'required|max:10',   
            'content' => 'required|max:255',
        ]);
        
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
    }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $task = \App\Task::find($id);

        if (\Auth::user()->id === $task->user_id) {
            $user = \Auth::user();
            $task->delete();
        }
        return redirect('/');
        //return redirect()->back();
    }
}
