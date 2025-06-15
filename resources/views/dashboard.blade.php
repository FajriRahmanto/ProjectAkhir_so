@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="dashboard-container">

    <!-- Welcome Card -->
    <div class="welcome-card d-flex align-items-center">
        <div class="user-avatar">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
        <div>
            <div class="welcome-text">
                Welcome, {{ $user->name }}!
            </div>
            <div class="text-muted">Let's accomplish great things today! 🚀</div>
        </div>
    </div>    <!-- Progress Overview Card -->
    <div class="welcome-card d-flex align-items-center">
        <div class="progress-circle-container">
            <svg class="progress-circle" width="140" height="140">
                <circle cx="70" cy="70" r="60" fill="none" stroke="#e9ecef" stroke-width="12"/>
                <circle cx="70" cy="70" r="60" fill="none" stroke="#2196f3" stroke-width="12"
                    stroke-dasharray="376.991"
                    stroke-dashoffset="{{ 376.991 - (376.991 * $progress / 100) }}"
                    stroke-linecap="round"/>
            </svg>
            <div class="progress-value">{{ $progress }}%</div>
        </div>
        <div>
            <h3 class="mb-3">Progress Overview</h3>
            <div class="d-flex gap-3 mb-3">
                <span class="badge rounded-pill bg-primary">Total: {{ $tasks->count() }}</span>
                <span class="badge rounded-pill bg-success">Done: {{ $tasks->where('status','done')->count() }}</span>
                <span class="badge rounded-pill bg-warning text-dark">Active: {{ $tasks->where('status','!=','done')->count() }}</span>
            </div>
            <div>
                @php
                $next = $tasks->where('status','!=','done')->sortBy('due_date')->first();
                @endphp
                @if($next)
                <div class="alert alert-info py-2 px-3 mb-0 d-inline-block">
                    <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">event</i>
                    Next: {{ \Carbon\Carbon::parse($next->due_date)->format('d/m/Y') }} - {{ $next->title }}
                </div>
                @else
                <div class="alert alert-success py-2 px-3 mb-0 d-inline-block">
                    <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">check_circle</i>
                    All tasks completed!
                </div>
                @endif
            </div>
        </div>
    </div>    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="material-icons">assignment</i>
            </div>
            <div class="stat-value">{{ $tasks->count() }}</div>
            <div class="stat-label">Total Tasks</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="material-icons">check_circle</i>
            </div>
            <div class="stat-value">{{ $tasks->where('status','done')->count() }}</div>
            <div class="stat-label">Completed Tasks</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="material-icons">hourglass_empty</i>
            </div>
            <div class="stat-value">{{ $tasks->where('status','!=','done')->count() }}</div>
            <div class="stat-label">Pending Tasks</div>
        </div>
    </div>    <!-- Tasks Table -->
    <div class="mb-4">
        <h5 class="fw-bold mb-3">
            <i class="material-icons me-2" style="font-size:24px;vertical-align:text-bottom;color:#1976d2">list_alt</i>
            Your Tasks
        </h5>
        <div class="table-responsive tasks-table">
            <table class="table mb-0">
                <thead>
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
                    <tr>                        <td class="fw-semibold">{{ $task->title }}</td>
                        <td><span class="task-type-badge">{{ $task->type }}</span></td>
                        <td>
                            @if($task->priority == 'High')
                            <span class="priority-badge priority-high">High Priority</span>
                            @elseif($task->priority == 'Medium')
                            <span class="priority-badge priority-medium">Medium Priority</span>
                            @else
                            <span class="priority-badge priority-normal">Normal Priority</span>
                            @endif
                        </td>                        <td>                            <div class="d-flex align-items-center">
                                <i class="material-icons me-2" style="font-size:18px;color:#1976d2">event</i>
                                <div>
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                    @if($task->due_time)
                                    <div class="text-muted" style="font-size:0.85rem;">
                                        <i class="material-icons" style="font-size:14px;vertical-align:text-bottom">schedule</i>
                                        {{ \Carbon\Carbon::parse($task->due_time)->format('H:i') }}
                                    </div>
                                    @endif
                                    <div class="task-time"
                                         data-due-date="{{ $task->due_date }}"
                                         data-due-time="{{ $task->due_time ?? '23:59:59' }}"
                                         style="font-size:0.85rem; color: #666;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($task->description)
                            <span class="text-muted">{{ $task->description }}</span>
                            @else
                            <span class="text-muted fst-italic">No description</span>
                            @endif
                        </td>
                        <td>                            @if($task->status == 'done')
                            <span class="priority-badge priority-normal">
                                <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">check_circle</i>
                                Done
                                <div class="text-muted" style="font-size:0.8rem;">
                                    {{ $task->completed_at ? $task->completed_at->format('d/m/Y H:i') : 'N/A' }}
                                </div>
                            </span>
                            @else
                            <span class="priority-badge priority-medium">
                                <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">pending</i>
                                Active
                            </span>
                            @endif
                        </td>                        <td>
                            <div class="d-flex gap-2">
                                @if($task->status != 'done')
                                <form action="{{ route('tasks.done', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-button btn btn-success btn-sm">
                                        <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">check</i>
                                        Done
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('tasks.edit', $task->id) }}" class="action-button btn btn-info btn-sm">
                                    <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">edit</i>
                                    Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button btn btn-danger btn-sm">
                                        <i class="material-icons" style="font-size:16px;vertical-align:text-bottom">delete</i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="material-icons" style="font-size:48px;">assignment</i>
                                <p class="mt-2">No tasks yet. Create your first task to get started!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="{{ asset('js/task-time.js') }}"></script>
@endsection
