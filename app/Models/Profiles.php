<?php

namespace App\Models;
use Carbon\Carbon;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'email',
        'birth_data',
        'phone',
        'picture',
        'status_profile',
        'created_at'
    ];

    protected $casts = [
        'birth_data' => 'datetime: M d, h:i',
        'created_at' => 'datetime: M d, h:i',
        'updated_at' => 'datetime: M d, h:i',
    ];

    /** @return ProfileFactory */
    protected static function newFactory()
    {
        return ProfileFactory::new();
    }
}
