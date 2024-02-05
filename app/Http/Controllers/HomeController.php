<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userType = Auth::user()->user_type;

        switch ($userType) {
            case 'admin':
                return view('home'); // Change to the actual view for admin
            case 'superadmin':
                return view('home'); // Change to the actual view for superadmin
            default:
                return view('user_home');
        }
    }

    public function getUsers(Request $request)
    {
        $users = User::paginate(10); // You can adjust the number of users per page

        return response()->json($users);
    }


}
