<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'status',
        'id_kategori',
        'id_pelaporan',
        'feedback'
    ];

    public function inputAspiration()
    {
        return $this->belongsTo(InputAspiration::class, 'id_pelaporan');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}
