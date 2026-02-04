<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspiration extends Model
{
    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket'
    ];
    
    public function aspiration()
    {
        return $this->hasOne(Aspiration::class, 'id_pelaporan');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}
