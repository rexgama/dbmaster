<?php

namespace Rexgama\DBMaster\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicSchema extends Model
{
    protected $fillable = [
        'table_name',
        'schema_definition',
        'form_definition',
        'api_enabled',
        'api_routes'
    ];

    protected $casts = [
        'schema_definition' => 'array',
        'form_definition' => 'array',
        'api_routes' => 'array'
    ];
}