<?php

namespace App\Models;

use App\Base as Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
                    'alias',
                    'link',
                    'image',
                    'image_right',
                    'gallery_id',
                    'position',
                    'active',
                    'on_header',
                    'on_drop_down',
                    'on_footer'
                ];

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        return $this->translation->title;
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'id', 'gallery_id');
    }

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(PageTranslation::class, 'page_id')->where('lang_id', self::$lang);
    }

    public function translation_()
    {
        return $this->hasOne(PageTranslation::class, 'page_id')->select('title')->where('lang_id', self::$lang);
    }

    public function galleryItems()
    {
        return $this->hasMany(SetGallery::class, 'set_id', 'id')->orderBy('main', 'desc');
    }
}
