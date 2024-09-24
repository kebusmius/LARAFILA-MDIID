<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Gspelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_customer',
        'gsmdiid_id',
        
    ];

    public function gsmdiid(): BelongsTo
    {
        return $this->belongsTo(Gsmdiid::class);
    }

    public function gstransaksi(): HasMany
    {
        return $this->hasMany(Gstransaksi::class);
    }
}
