<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('due_date')->get();
        return view('todo', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'due_date' => 'required|date',
            'due_time' => 'nullable',
            'priority' => 'required|string',
            'description' => 'nullable|string',
        ]);
        Task::create([
            'title' => $request->title,
            'type' => $request->type,
            'due_date' => $request->due_date,
            'due_time' => $request->due_time,
            'priority' => $request->priority,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
        return redirect('/');
    }
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $tasks = Task::where('user_id', $user->id)
            ->orderByDesc('priority')
            ->orderBy('due_date')
            ->get();

        $total = $tasks->count();
        $done = $tasks->where('status', 'done')->count();
        $progress = $total > 0 ? round(($done / $total) * 100) : 0;

        return view('dashboard', compact('user', 'tasks', 'progress'));
    }
    public function edit($id)
    {
        $tugas = Task::findOrFail($id);
        return view('tasks.edit', compact('tugas'));
    }
    public function markDone($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'done';
        $task->completed_at = now();
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as done!');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return back()->with('success', 'Task deleted!');
    }
    public function history()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)
            ->where('status', 'done')
            ->orderByDesc('updated_at')
            ->get();

        return view('tasks.history', compact('user', 'tasks'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'due_date' => 'required|date',
            'due_time' => 'nullable',
            'priority' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'type' => $request->type,
            'due_date' => $request->due_date,
            'due_time' => $request->due_time,
            'priority' => $request->priority,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }
}
