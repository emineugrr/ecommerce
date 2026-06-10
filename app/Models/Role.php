<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    // Bir rol birden fazla kullanıcıda olabilir
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
