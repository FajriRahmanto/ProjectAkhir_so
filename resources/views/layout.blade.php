<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .sidebar-blue {
            background: linear-gradient(135deg, #1976d2 0%, #2196f3 100%);
            min-height: 100vh;
            width: 220px;
            position: relative;
            box-shadow: 2px 0 16px 0 rgba(25, 118, 210, 0.08);
        }

        .sidebar-blue .nav-link {
            color: #fff;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            padding: 10px 18px;
            letter-spacing: 0.5px;
        }

        .sidebar-blue .nav-link.active,
        .sidebar-blue .nav-link:hover {
            background: linear-gradient(90deg, #1565c0 0%, #42a5f5 100%);
            color: #fff;
            box-shadow: 0 2px 8px 0 rgba(33, 150, 243, 0.12);
        }

        .sidebar-blue .logout-area {
            position: absolute;
            bottom: 32px;
            left: 0;
            width: 100%;
        }

        .sidebar-blue .logout-btn {
            padding: 12px 20px;
            border: none;
            background: linear-gradient(90deg, #1565c0 0%, #42a5f5 100%);
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.2s, box-shadow 0.2s;
            color: #fff;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px 0 rgba(33, 150, 243, 0.10);
        }

        .sidebar-blue .logout-btn:hover {
            background: linear-gradient(90deg, #0d47a1 0%, #1976d2 100%);
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 16px 0 rgba(21, 101, 192, 0.15);
        }

        /* Modern blue for main content elements */
        .modern-blue {
            background: linear-gradient(90deg, #2196f3 0%, #e3f2fd 100%);
            color: #1565c0;
            border-radius: 12px;
            box-shadow: 0 2px 12px 0 rgba(33, 150, 243, 0.08);
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar-blue p-3 d-flex flex-column position-relative">
            <h4 class="text-white mb-4">Menu</h4>
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                        To Do List
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.history') }}" class="nav-link {{ request()->routeIs('tasks.history') ? 'active' : '' }}">
                        Task History
                    </a>
                </li>
            </ul>
            <div class="logout-area">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span class="material-icons" style="font-size:20px;">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>
</body>

</html>