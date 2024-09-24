<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Produk extends Model
{
    use HasFactory;

    protected $fillable =['nama', 'keterangan'];

    public function estransaksi(): BelongsTo
    {
        return $this->hasMany(Estransaksi::class);
    }

    public function invoices()
{
    return $this->belongsToMany(Invoice::class);
}
}
