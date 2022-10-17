<?php

namespace App\Services\User;

use App\Enums\UserType;
use App\Helper\PasswordGeneratorHelper;
use App\Models\AppUser;
use App\Models\Role;
use App\Models\User;
use App\Traits\CrudTraits;
use Illuminate\Support\Facades\Auth;

class UserService
{
    use CrudTraits;

    protected $model;

    public function __construct (AppUser $user)
    {
        $this->model = $user;
    }

    public function save($data,$user = null) 
    {
        $user = $user == null?$this->model:$user;
        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];
        $user->password   = !empty($data['password'])?$data['password']:PasswordGeneratorHelper::generate();
        if(!empty($data['user_type'])){
            if($data['user_type'] == Role::where('description',UserType::BLOGGER)->first()->id){
                $supervisor = $this->loadById($data['supervisor_id']);
                $user->supervisor()->associate($supervisor);
            }
            $user->role()->associate(Role::where('id',$data['user_type'])->first());    
        }
       
        return $user->save();
    }

    public function getByRole($role,$eagerAsignees = false) 
    {
        $query = $this->model->query();
        if($eagerAsignees){
            $query->with('assignees');
        }
        $query->where('role_id',$role->id);
        return $query->get();
    }

    public function listAsignees(){
        switch(Auth::user()->role->description){
            case UserType::ADMIN:
                return $this->model->paginate(20);
            case UserType::SUPERVISOR:
                return $this->model->where('supervisor_id',Auth::user()->id)->paginate(20);
        }
        
    }
}
