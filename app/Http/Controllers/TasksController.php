<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Html\Requests;

use App\Task;   //追加

class TasksController extends Controller
{
    //getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            return view("tasks.index", [
                "tasks" => $tasks,
            ]);
        }
        else {
            return view('welcome');
        }
    }   
    
    //getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;
        
        return view("tasks.create", [
                "task" => $task,
            ]);
    }
    
    //postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $this->validate($request, [
            "status" => "required|max:10",  
            "content" => "required|max:191",
        ]);
        
        
        $request->user()->tasks()->create([
            "content" => $request->content,
            "status" => $request->status,
            
        ]);
        
        return redirect("tasks/");
    }
    
    //getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            return view("tasks.show", [
                    "task" => $task,
            ]);
        }
        else {
            return redirect("tasks/");
        }
    }
    
    //getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            return view("tasks.edit", [
                "task" => $task,
            ]);
        } else {
            return redirect("tasks/");
        }
    }
    
    //putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "status" => "required|max:10",      //追加
            "content" => "required|max:191",    //追加
        ]);
        
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
            
            $task->status = $request->status;       //追加
            $task->content = $request->content;
            $task->save();
        }
        return redirect("tasks/");
    }
    
    //deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::user()->id === $task->user_id) {
        
            $task->delete();
        }
        
        return redirect("tasks/");
    }
}
