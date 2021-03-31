<?php

namespace App\Models;

use App\Base as Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['alias', 'department_id', 'image'];

    public function translations()
    {
        return $this->hasMany(TeamTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(TeamTranslation::class, 'team_id')->where('lang_id', self::$lang);
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
