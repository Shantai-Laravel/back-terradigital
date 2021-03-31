<?php
namespace App\Models;

use App\Base as Model;

class AccordionItem extends Model
{
    protected $table = 'accordion_items';

    protected $fillable = ['category_id', 'alias'];

    public function translations()
    {
        return $this->hasMany(AccordionItemTranslation::class, 'accordion_item_id');
    }

    public function translation()
    {
        return $this->hasOne(AccordionItemTranslation::class, 'accordion_item_id')->where('lang_id', self::$lang);
    }
}
