<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get project id for fileter task
        $projectId = $request->project_id;
        //get all task
        $tasksQuery = Task::orderBy('priority', 'asc')->with(['project']);
        // if filter apply 
        $tasksQuery->when($projectId, function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        });
        // all task with paginatin
        $tasks = $tasksQuery->paginate(10);
        // all projects for filter task
        $projects = Project::all();
        return view('pages.task.list', ['tasks' => $tasks, 'projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('pages.task.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // we can move this validation on common file 
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Task name is required'
        ]);
        // get task object
        $task = new Task();
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        $projects = Project::all();
        return view('pages.task.edit', ['task' => $task, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Task name is required'
        ]);

        $task = Task::find($id);
        $task->name = $request->name;
        $task->project_id = $request->project_id;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task removed successfully.');
    }

    public function shorting(Request $request)
    {
        $shortedIds = $request->sortedIds;
        foreach ($shortedIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
    }
}
