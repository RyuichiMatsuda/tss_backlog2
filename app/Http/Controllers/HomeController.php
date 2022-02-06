<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Incident;
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

    public function index()
    {
        return redirect()->route('incidents.index');
    }

    public function dashboard()
    {
        $incidents = Incident::select()->latest()->paginate(12);

        return view('dashboard', compact('incidents'));
    }

}
