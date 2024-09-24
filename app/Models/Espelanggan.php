<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Espelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_customer',
        'esmdiid_id',
        
    ];

    public function esmdiid(): BelongsTo
    {
        return $this->belongsTo(Esmdiid::class, 'esmdiid_id');
    }

    public function estransaksis()
    {
        return $this->hasMany(Estransaksi::class);
    }
}
