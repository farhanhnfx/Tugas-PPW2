<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingBuku extends Model
{
    use HasFactory;

    protected $table = 'rating_buku';
    protected $primaryKey = 'id';
    protected $fillable = ['buku_id', 'user_id', 'rating'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

}
