<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Estransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function espelanggan(): BelongsTo
    {
        return $this->belongsTo(Espelanggan::class);
    }

    public function esmdiid(): BelongsTo
    {
        return $this->belongsTo(Esmdiid::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }

}
