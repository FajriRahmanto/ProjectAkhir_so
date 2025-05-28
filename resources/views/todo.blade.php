@extends('layout')

@section('content')
<div class="p-0" style="background:#f9f9f9;min-height:100vh;">
    <div class="container py-4">

        <!-- Statistik Ringkas -->
        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2rem;color:#1976d2;">
                            <span class="material-icons">assignment</span>
                        </div>
                        <div class="fw-bold" style="font-size:1.1rem;">Total Tasks</div>
                        <div class="fs-4">{{ $tasks->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2rem;color:#43a047;">
                            <span class="material-icons">check_circle</span>
                        </div>
                        <div class="fw-bold" style="font-size:1.1rem;">Completed</div>
                        <div class="fs-4">{{ $tasks->where('status','done')->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2rem;color:#ffa000;">
                            <span class="material-icons">hourglass_empty</span>
                        </div>
                        <div class="fw-bold" style="font-size:1.1rem;">Pending</div>
                        <div class="fs-4">{{ $tasks->where('status','!=','done')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Task Form -->
        <div class="card shadow rounded mb-4" style="max-width:800px;margin:auto;">
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Task Title</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="material-icons" style="font-size:18px;">edit</i></span>
                            <input type="text" name="title" class="form-control" placeholder="Enter task title..." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Task Type</label>
                        <select name="type" class="form-select">
                            <option value="Work">Work</option>
                            <option value="Personal">Personal</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Priority</label>
                        <select name="priority" class="form-select">
                            <option value="High">High</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="Normal">Normal</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Due Time</label>
                        <input type="time" name="due_time" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Description (Optional)</label>
                        <input type="text" name="description" class="form-control" placeholder="Add details about your task...">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4" style="font-weight:bold;">
                            + Add Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Next Deadline -->
        <div class="mb-3">
            @php
            $next = $tasks->where('status','!=','done')->sortBy('due_date')->first();
            @endphp
            @if($next)
            <span class="badge bg-info text-dark">
                Next Deadline: {{ \Carbon\Carbon::parse($next->due_date)->format('d/m/Y') }} - {{ $next->title }}
            </span>
            @else
            <span class="badge bg-secondary">No upcoming tasks</span>
            @endif
        </div>

        <!-- Task List Table -->
        <div class="table-responsive">
            <table class="table align-middle table-bordered shadow-sm bg-white rounded">
                <thead class="table-primary">
                    <tr>
                        <th>Task Title</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th style="min-width:140px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td class="fw-semibold">{{ $task->title }}</td>
                        <td>{{ $task->type }}</td>
                        <td>
                            @if($task->priority == 'High')
                            <span class="badge bg-danger">High</span>
                            @elseif($task->priority == 'Medium')
                            <span class="badge bg-warning text-dark">Medium</span>
                            @else
                            <span class="badge bg-secondary">Normal</span>
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                            @if($task->due_time)
                            <span class="text-muted">{{ \Carbon\Carbon::parse($task->due_time)->format('H:i') }}</span>
                            @endif
                        </td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if($task->status == 'done')
                            <span class="badge bg-success">Completed</span>
                            @else
                            <span class="badge bg-warning text-dark">Active</span>
                            @endif
                        </td>
                        <td>
                            @if($task->status != 'done')
                            <form action="{{ route('tasks.done', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm mb-1">Finish</button>
                            </form>
                            @endif
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info mb-1">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No tasks yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection