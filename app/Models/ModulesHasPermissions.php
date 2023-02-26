<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulesHasPermissions extends Model
{
    protected $fillable = [
        'module_id' , 'permission_id'
    ];
    public function module()
    {
        return $this->hasOne('App\Module', 'id', 'module_id');
    }
    public function permission()
    {
        return $this->hasOne('Spatie\Permission\Models\Permission', 'id', 'permission_id');
    }
}
