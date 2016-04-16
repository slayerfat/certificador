<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $ids  = $user->personalDetails->events->pluck('id');

        $events = Event::whereNotIn('id', $ids)
                       ->active()
                       ->latest()
                       ->limit(5)
                       ->get();

        return view('home', compact('events', 'user'));
    }
}
