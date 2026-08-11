<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetField extends Model
{
    protected $table = 'widget_fields';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'value',
        'widget_id',
        'widget_field_id',
        'position',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}
