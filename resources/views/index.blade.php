<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="text-center text-white bg-primary py-3 rounded">My To-Do List</h2>

    <div class="task-box mt-4">
        <!-- Form Input Task -->
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title..." required>
                </div>
                <div class="col-md-4">
                    <label for="type" class="form-label">Task Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="Work">Work</option>
                        <option value="Personal">Personal</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Add details about your task..."></textarea>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">+ Add Task</button>
            </div>
        </form>

        <hr>

        <!-- Search & Filter -->
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Search tasks...">
            </div>
            <div class="col-md-6 text-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary tab-button active">All</button>
                    <button type="button" class="btn btn-outline-primary tab-button">Active</button>
                    <button type="button" class="btn btn-outline-primary tab-button">Completed</button>
                </div>
            </div>
        </div>

        <!-- Task List Placeholder -->
        <div class="text-center text-muted my-5">
            <i class="bi bi-clipboard task-icon"></i>
            <p class="mt-2">No tasks yet</p>
            <small>Add a new task to get started</small>
        </div>

        <!-- Footer -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <span>0 tasks left</span>
            <button class="btn btn-outline-danger">
                <i class="bi bi-trash"></i> Clear Completed
            </button>
        </div>
    </div>
</div>
</body>
</html>
