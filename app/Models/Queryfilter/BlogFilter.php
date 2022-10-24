<?php

namespace App\Models\Queryfilter;

use App\Models\QueryFilter\QueryFilters;

class BlogFilter extends QueryFilters
{
   
    protected $filterable = [    
        'search'
    ];

    public function search($keyword)
    {
        return $this->builder->where(function ($query) use ($keyword) {
            $query->orWhere('name', 'like', '%' . $keyword . '%');
            $query->orWhere('description', 'like', '%' . $keyword . '%');
        });
    }
    
}
