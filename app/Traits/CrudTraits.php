<?php

namespace App\Traits;

trait CrudTraits
{
    public function list(){
        return $this->model->paginate(20);
    }

    public function save($data = []){
        return $this->model->create($data);
    }

    public function update($data,$id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    public function loadById($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();
    }
}
