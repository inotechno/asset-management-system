<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'supplier_id', 'uid', 'specification', 'production_year', 'purchase_date', 'purchase_price', 'condition', 'status'];
    /**
     * Get the category that owns the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the supplier that owns the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get all of the transaction_detail for the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Get all of the image for the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function image()
    {
        return $this->hasMany(AssetImages::class);
    }
}
