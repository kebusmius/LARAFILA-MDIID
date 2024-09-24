<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str; // Add this import



class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'no_invoice',
        'esmdiid_id',
        'espelanggan_id',
        'barang',
        'tanggal',
        'total_invoice',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'barang' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            if (empty($invoice->no_invoice)) {
                $invoice->no_invoice = self::generateUniqueInvoiceNumber();
            }
        });
    }

    protected static function generateUniqueInvoiceNumber()
    {
        do {
            $number = 'INV-' . strtoupper(Str::random(8));
        } while (self::where('no_invoice', $number)->exists());

        return $number;
    }

    public function esmdiid()
    {
        return $this->belongsTo(Esmdiid::class);
    }

    public function espelanggan()
    {
        return $this->belongsTo(Espelanggan::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
