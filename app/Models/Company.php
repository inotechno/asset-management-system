<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    /**
     * Get all of the division for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function division()
    {
        return $this->hasMany(Division::class);
    }
}
