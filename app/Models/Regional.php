<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];
    /**
     * Get all of the division for the Regional
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function division()
    {
        return $this->hasMany(Division::class);
    }
}
