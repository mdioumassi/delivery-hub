<?php

namespace App\Models;

use App\Enums\CivilityEnum;
use App\Enums\PersonTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $table = 'persons';
    
    protected $fillable = [
        'type',
        'civility',
        'fullname',
        'phone',
        'address',
        'city',
        'zip_code',
        'country',
        'user_id',
    ];

    protected $casts = [
        'civility' => CivilityEnum::class,
        'type' => PersonTypeEnum::class,
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
