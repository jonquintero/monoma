<?php

namespace Modules\UserAndLead\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\UserAndLead\Database\Factories\LeadFactory;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'source',
        'owner',
        'created_by',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    protected static function newFactory(): LeadFactory
    {
        return new LeadFactory();
    }

    // Relaciones y otros métodos del modelo
}
