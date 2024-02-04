<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NumberFormatter;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo( Customer::class );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo( Product::class );
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo( Invoice::class );
    }
}
