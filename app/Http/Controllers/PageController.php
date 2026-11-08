<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

class PageController extends Controller
{
    public function home()
    {
        $tasks = Task::where('is_archived', false)
            ->whereDate('task_date', today())
            ->orderBy('id')
            ->get();

        return view('pages.home', compact('tasks'));
    }

    public function profile()
    {
        $user = User::first();

        return view('pages.profile', compact('user'));
    }

    public function about()
    {
        return view('pages.about');
    }
}