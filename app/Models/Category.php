<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    /**
     * Get all of the asset for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
