<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class History extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function product(): BelongsTo
    {
        return $this->belongsTo( Product::class );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo( Customer::class );
    }
}
