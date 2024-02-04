<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsM extends Model
{
    use HasFactory;
     protected $table="products";
     protected $fillable= 
     ["id","id_kategori","nama_produk","harga_produk","stok","dproduk","tanggal_masuk","foto_produk"];

     public function category()
     {
         return $this->belongsTo(KategoriM::class, 'id_kategori', 'id');
     }
     
     public function transactions()
     {
        return $this->hasMany(TransactionsM::class,'id_produk');
     }

     public function searchableAs()
     {
         return 'products';
     }
 
     public function toSearchableArray()
     {
         return [
             'tanggal_masuk'     => $this->tanggal_masuk,
             'nama_produk'     => $this->nama_produk,
             'harga_produk'     => $this->harga_produk,
             'kategori'     => $this->kategori,
             
         ];
     }
 
}
