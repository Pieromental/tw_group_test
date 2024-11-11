<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = ['role_id', 'name', 'created_by'];

  
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
