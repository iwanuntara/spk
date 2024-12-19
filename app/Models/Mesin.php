<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;
    protected $table = 'mesin';
    protected $fillable = [
        'no_mesin',
        'nama_mesin',
        'riwayat_mesin',
    ];
    public function spks()
    {
        return $this->hasMany(Spk::class);
    }
}
