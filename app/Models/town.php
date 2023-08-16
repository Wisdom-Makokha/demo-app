<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class town extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subcountyid'
    ];

    public function users():HasMany {
        return $this->hasMany(related: User::class, foreignKey: 'townid', localKey: 'id');
    }

    public function subcounty():BelongsTo {
        return $this->belongsTo(related: subcounty::class, foreignKey: 'subcountyid', ownerKey: 'id');
    }
}
