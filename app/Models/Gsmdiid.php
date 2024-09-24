<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Gsmdiid extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "no_account",
        "nama",
        "total",
        "pph"
    ];

    public function gspelanggan(): HasMany
    {
        return $this->hasMany(Gspelanggan::class);
    }

    public function gstransaksi(): HasMany
    {
        return $this->hasMany(Gstransaksi::class);
    }
}
