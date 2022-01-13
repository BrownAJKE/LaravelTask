<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //users list
    public function index()
    {
        $users = User::all();
        return view ('users.users', compact('users'));
    }

    //notifications
    public function notifications()
    {
        //mark notification as read

        auth()->user()->unreadNotifications->markAsRead();

        //show all the notification to the user

        return view('users.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }

}
