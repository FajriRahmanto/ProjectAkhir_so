
@extends('layout')

@section('content')
<div class="p-4" style="background:#f9f9f9;min-height:100vh;">
    <h2 class="mb-4 fw-bold">Task History</h2>
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm bg-white rounded">
            <thead class="table-success">
                <tr>
                    <th>Task Title</th>
                    <th>Type</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Description</th>
                    <th>Completed At</th>
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
                    <td>{{ \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No completed tasks yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection