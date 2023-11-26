<?php

namespace App\Models;

use App\Traits\ScopeLimitData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, ScopeLimitData;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
