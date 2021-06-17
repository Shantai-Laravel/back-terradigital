<?php

namespace App\Models;

use App\Base as Model;

class PromoSectionTranslation extends Model
{
    protected $table = 'promos_sections_translation';

    protected $fillable = [
        'lang_id',
        'promo_section_id',
        'title',
        'body',
    ];

    public function promotion()
    {
        return $this->belongsTo(PromoSection::class);
    }
}
