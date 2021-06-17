<?php

namespace App\Models;

use App\Base as Model;

class PromoSection extends Model
{
    protected $table = 'promos_sections';

    protected $fillable = [
        'promotion_id',
        'image',
        'deleted',
        'number'
    ];

    public function translations()
    {
        return $this->hasMany(PromoSectionTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(PromoSectionTranslation::class, 'promo_section_id')->where('lang_id', self::$lang);
    }
}
