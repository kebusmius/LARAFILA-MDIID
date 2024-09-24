<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esmdiid extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_account",
        "nama",
        "total",
        "pph"
    ];

    public function setAttribute($key, $value)
    {
        // List of fields to be converted to uppercase
        $uppercaseFields = ['pph', 'nama', 'no_account'];

        if (in_array($key, $uppercaseFields) && is_string($value)) {
            $value = strtoupper($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getTotalAttribute()
    {
        return $this->espelanggans->sum(function($espelanggan) {
            return $espelanggan->estransaksis->sum('nominal');
        });
    }

    public function espelanggans()
    {
        return $this->hasMany(Espelanggan::class, 'esmdiid_id');
    }

    public function estransaksis(): BelongsTo
    {
        return $this->belongsTo(Estransaksi::class, 'esmdiid_id');
    }
}
