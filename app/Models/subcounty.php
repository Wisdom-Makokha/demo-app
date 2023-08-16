<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class subcounty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'subcounty';

    public function town(): HasMany{
        return $this->hasMany(related: town::class, foreignKey: 'subcountyid', localKey: 'id');
    }
}
