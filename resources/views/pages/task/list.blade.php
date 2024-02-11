@extends('layout.default')
@section('content')
<div class="row mb-2">
    <div class="col-md-7"></div>
    <div class="col-md-5">
        <form type="get" action="">
            <div class="input-group">
                <select class="custom-select" name="project_id">
                    <option selected>Choose...</option>
                    @foreach($projects as $project)
                    <option @if(Request::get('project_id')==$project->id) selected @endif value="{{ $project->id }}">{{$project->name}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="text-success text-center" id="sorting-m"></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Task ID</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Project</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($tasks as $task)
                <tr data-task-id="{{ $task->id }}">
                    <th scope="row">#{{ $task->id }}</th>
                    <td>{{ $task->name }}
                    </td>
                    <td style="text-transform: capitalize;">{{ $task->project->name }}</td>
                    <td>{{ $task->created_at->diffForHumans() }}</td>
                    <td style="display: flex;">
                        <form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a style="margin-left: 5px;" href="{{ asset(url('task/'.$task->id.'/edit')) }}" class="btn btn-primary btn-sm">Edit Task</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </div>
</div>
<script>
    $(function() {
        $("#sorting-m").hide();
        $("#sortable").sortable({
            update: function(event, ui) {
                console.log("Sorting completed");
                var sortedIds = $("#sortable tr").map(function() {
                    return $(this).data("task-id");
                }).get();

                // Make your API call here
                $.ajax({
                    url: '/task/shorting',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        sortedIds: sortedIds
                    },
                    success: function(response) {
                        $("#sorting-m").show().text('Task Sorting successfully.')
                        setTimeout(() => {
                            $("#sorting-m").hide();
                        }, 2000);
                    },
                    error: function(error) {
                        //error
                    }
                });
            }
        });
    });
</script>
@endsection