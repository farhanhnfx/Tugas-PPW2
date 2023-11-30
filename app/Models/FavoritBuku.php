<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritBuku extends Model
{
    use HasFactory;

    protected $table = 'favourite';
    protected $primaryKey = 'id';
    protected $fillable = ['buku_id', 'user_id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
