<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();
        $current_folder = Folder::find($id);
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }
    
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }
    
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);
    
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->image_path = $request->image_path;
    
        $current_folder->tasks()->save($task);
    
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
    
    public function destroy(int $id, $task_id) {
        $current_folder = Folder::find($id);
        $current_task = Task::find($task_id);
        
        $current_task->delete();
        
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
     }
}