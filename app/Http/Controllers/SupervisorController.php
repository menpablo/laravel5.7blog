<?php

namespace App\Http\Controllers;

use App\Actions\GetsUserByRole;
use App\Enums\UserType;
use App\Services\Blog\BlogFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
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
    public function index(GetsUserByRole $getsUserByRole)
    {
        $supervisors = $getsUserByRole(UserType::SUPERVISOR,true);
        return view('supervisors.home')->with('supervisors',$supervisors);                        
    }
}
