<?php

namespace App\Models;

use App\Base as Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = ['alias'];

    public function translations()
    {
        return $this->hasMany(DepartmentTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(DepartmentTranslation::class, 'department_id')->where('lang_id', self::$lang);
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'department_id', 'id');
    }
}
