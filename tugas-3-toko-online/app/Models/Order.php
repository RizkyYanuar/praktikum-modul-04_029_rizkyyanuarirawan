<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order',
        'id_user',
        'tanggal_order',
        'total_harga',
        'alamat_pengiriman',
    ];

    protected $casts = [
        'tanggal_order' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id_order');
    }
    
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details', 'id_order', 'id_barang')
                    ->withPivot('harga_satuan', 'jumlah_beli')
                    ->withTimestamps();
    }
}