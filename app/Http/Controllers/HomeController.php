<?php

namespace App\Http\Controllers;

use App\Actions\GetsUserByRole;
use App\Enums\UserType;
use App\Services\Blog\BlogFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(GetsUserByRole $getsUserByRole)
    {
        //$s = $getsUserByRole(UserType::SUPERVISOR);        
        return view('home')->with('user',Auth::user())
                           ->with('total_blogs', BlogFacade::list()->total())
                           ->with('total_supervisors',$getsUserByRole(UserType::SUPERVISOR)->count())
                           ->with('total_bloggers',$getsUserByRole(UserType::BLOGGER)->count());

    }
}
