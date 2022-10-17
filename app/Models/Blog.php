<?php

namespace App\Models;

use App\Scopes\BlogListByRole;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BlogListByRole());
    }
}
