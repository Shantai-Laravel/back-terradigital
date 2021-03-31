<?php
namespace App\Models;

use App\Base as Model;


class CategoriesOpacId extends Model
{
    protected $table = 'categories_opac_ids';

    protected $fillable = [ 'category_id', 'opac_id', 'product_id' ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }
}
