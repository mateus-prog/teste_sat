<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\BaseModel;


class Individual extends BaseModel
{
    public const TABLE = 'individuals';
    protected $table = self::TABLE;
    public $timestamps = true;

    public $fillable = [
        'name', 
        'document',
        'mail',
        'phone', 
        'address', 
        'number', 
        'complement', 
        'district', 
        'city', 
        'cep', 
        'state', 
        'active',
    ];
	public $searchable = [
        'name', 
        'document', 
        'mail',
        'phone',
        'address', 
        'number', 
        'complement', 
        'district', 
        'city', 
        'cep', 
        'state', 
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'document' => 'integer',
        'mail' => 'string',
        'phone' => 'integer',
        'address' => 'string',
        'number' => 'string',
        'complement' => 'string',
        'district' => 'string',
        'city' => 'string',
        'cep' => 'integer',
        'state' => 'string',
        'active' => 'boolean',
    ];
}
