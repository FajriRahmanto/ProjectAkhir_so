<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
</head>

<body>
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 400px;">
            <div class="card-header text-center">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>                    <p class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
