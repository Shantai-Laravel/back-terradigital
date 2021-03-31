<?php

namespace App\Models;

use App\Base as Model;

class TeamTranslation extends Model
{
    protected $table = 'teams_translation';

    protected $fillable = [
                    'lang_id',
                    'team_id',
                    'name',
                    'function',
                    'email',
                    'phone',
                    'info',
                    'image',
                ];

    public function department()
    {
        return $this->belongsTo(Team::class);
    }
}
