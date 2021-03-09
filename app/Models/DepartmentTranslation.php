<?php

namespace App\Models;

use App\Base as Model;

class DepartmentTranslation extends Model
{
    protected $table = 'department_translation';

    protected $fillable = [
                    'lang_id',
                    'department_id',
                    'name',
                    'info'
                ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function lang()
    {
        return $this->hasOne(Lang::class, 'id', 'lang_id');
    }
}
