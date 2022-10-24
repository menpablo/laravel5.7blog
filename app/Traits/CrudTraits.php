<?php

namespace App\Traits;

use App\Models\QueryFilter\QueryFilters;

trait CrudTraits
{
    public function list(QueryFilters $filter = null){
        $query = $this->model->query();
        if($filter){
            $query->filter($filter);
        }
        return $query->paginate(20);
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
