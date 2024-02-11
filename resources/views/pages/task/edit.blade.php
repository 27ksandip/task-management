@extends('layout.default')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-6">
        {{ Form::open(array('url' => 'task/'.$task->id,'method' => 'put')) }}
        <div class="form-group">
            <label><b>Task Name</b></label>
            <input type="text" class="form-control" name="name" value="{{ $task->name }}" />
        </div>
        <div class="form-group">
            <label><b>Project</b></label>
            <select class="custom-select" name="project_id">
                <option selected>Select Project</option>
                @foreach($projects as $project)
                <option @if($task->project_id == $project->id) selected @endif value="{{ $project->id }}">{{$project->name}}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
        @endforeach
        @endif
        <button type="submit" class="btn btn-primary">Create Task</button>
        {{ Form::close() }}
    </div>
</div>
@endsection