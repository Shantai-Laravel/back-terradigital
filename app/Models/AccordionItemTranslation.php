<?php
namespace App\Models;

use App\Base as Model;

class AccordionItemTranslation extends Model
{
    protected $table = 'accordion_items_translations';

    protected $fillable = ['lang_id', 'accordion_items_translations', 'title', 'link'];

    public function accordion()
    {
        return $this->belongsTo(AccordionItem::class);
    }
}
