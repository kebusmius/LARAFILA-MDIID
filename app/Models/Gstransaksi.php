<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Gstransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gspelanggan(): BelongsTo
    {
        return $this->belongsTo(Gspelanggan::class);
    }

    public function gsmdiid(): BelongsTo
    {
        return $this->belongsTo(Gsmdiid::class);
    }
}
