<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class phone extends Model
{
    use HasFactory;

    protected $fillable =[
        'phonenumber',
        'userid'
    ];

    public function user ():BelongsTo {
        return $this->belongsTo(related: User::class, foreignKey: 'userid', ownerKey: 'id');
    }
}
