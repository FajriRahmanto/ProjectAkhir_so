@extends('layout')

@section('content')
<div class="p-0" style="background:#f9f9f9;min-height:100vh;">
    <div class="container py-4">
        <div class="card shadow rounded" style="max-width:800px;margin:auto;">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Edit Task</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $tugas->id) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Task Title</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="material-icons" style="font-size:18px;">edit</i></span>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $tugas->title) }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Task Type</label>
                        <select name="type" class="form-select">
                            <option value="Work" {{ $tugas->type == 'Work' ? 'selected' : '' }}>Work</option>
                            <option value="Personal" {{ $tugas->type == 'Personal' ? 'selected' : '' }}>Personal</option>
                            <option value="Urgent" {{ $tugas->type == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="Other" {{ $tugas->type == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Priority</label>
                        <select name="priority" class="form-select">
                            <option value="High" {{ $tugas->priority == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Medium" {{ $tugas->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="Normal" {{ $tugas->priority == 'Normal' ? 'selected' : '' }}>Normal</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Due Date</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $tugas->due_date) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Due Time</label>
                        <input type="time" name="due_time" class="form-control" value="{{ old('due_time', $tugas->due_time) }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Description (Optional)</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description', $tugas->description) }}" placeholder="Add details about your task...">
                    </div>

                    <div class="col-12 text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4" style="font-weight:bold;">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
</html>
