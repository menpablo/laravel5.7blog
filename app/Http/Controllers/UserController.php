<?php

namespace App\Http\Controllers;

use App\Actions\GetsUserByRole;
use App\Enums\UserType;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\Role\RoleFacade;
use App\Services\User\UserFacade;
use App\Validators\EditsUserProfileValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('can_see_users',Auth::user());
        return view('users.index')->with('users',UserFacade::listAsignees());
                                 // ->with('roles',RoleFacade::list());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetsUserByRole $getsUserByRole)
    {
        $this->authorize('work_with_users',Auth::user());
        return view('users.create')->with('roles',RoleFacade::list())
                                   ->with ('supervisors',$getsUserByRole(UserType::SUPERVISOR));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('work_with_users',Auth::user());
        UserFacade::save($request->all());
        return view('users.index')->with('users',UserFacade::list());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,GetsUserByRole $getsUserByRole)
    {
        $this->authorize('can_see_users',Auth::user());
        return view('users.create')->with('user',$user)
                                   ->with('roles',RoleFacade::list())
                                   ->with ('supervisors',$getsUserByRole(UserType::SUPERVISOR));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('work_with_users',Auth::user());
        UserFacade::save($request->all(),$user);
        return view('users.index')->with('users',UserFacade::list());
    }

    public function editProfile(Request $request, EditsUserProfileValidator $editsUserProfileValidator)
    {
        $editsUserProfileValidator($request,Auth::user());
        UserFacade::update($request->all(),Auth::user()->id);;
        return back()->with('message', 'saved!'); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('work_with_users',Auth::user());

        //
    }
}
