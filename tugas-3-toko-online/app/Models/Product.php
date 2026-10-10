<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_barang', 'id_barang');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_details', 'id_barang', 'id_order')
                    ->withPivot('harga_satuan', 'jumlah_beli')
                    ->withTimestamps();
    }
}