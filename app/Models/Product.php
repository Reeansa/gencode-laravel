<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;
    
    
    protected $guarded = [ 'id' ];
    
    public function cart(): HasMany
    {
        return $this->hasMany( Cart::class );
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function productImage(): HasMany
    {
        return $this->hasMany(productImage::class);
    }
    
    public function scopeFilter( Builder $query, array $filters ): void
    {
        $query->when( $filters[ 'search' ] ?? false, function ($query, $search) {
            $query->where( 'name', 'like', '%' . $search . '%' )
            ->orWhere( 'description', 'like', '%' . $search . '%' );
        } );
    }
}
