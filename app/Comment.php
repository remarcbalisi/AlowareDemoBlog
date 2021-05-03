<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    public function parent()
    {
        return $this -> hasOne(self::class, 'id', 'parent_id');
    }

    public function children()
    {
        return self::hasMany(self::class, 'parent_id', 'id')->with('children');
    }
}
