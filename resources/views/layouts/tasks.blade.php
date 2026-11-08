<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tasks for Today')</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Welcome</a> |
        <a href="{{ route('tasks.index') }}">Task List</a> |
        <a href="{{ route('profile') }}">Profile</a> |
        <a href="{{ route('about') }}">About</a> |

        @auth
            <a href="{{ route('tasks.create') }}">New Task</a> |

            <form
                method="POST"
                action="{{ route('logout') }}"
                style="display:inline"
            >
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>
</body>
</html>