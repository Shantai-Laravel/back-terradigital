<?php
namespace App\Models;

use App\Base as Model;

class ServiceTranslation extends Model
{
    protected $table = 'services_translation';

    protected $fillable = [
                        'lang_id',
                        'service_id',
                        'title',
                        'description',
                        'package_1',
                        'package_2',
                        'package_3',
                    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
