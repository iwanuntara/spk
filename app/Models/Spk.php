<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;
    protected $table = 'spk';
    protected $fillable = [
        'nomor',
        'area_id',
        'mesin_id',
        'tanggal',
        'jam',
        'shift',
        'kategori',
        'permasalahan',
        'tindakan',
        'pemeriksaan',
        'penyebab',
        'perbaikan',
        'sparepart',
        'jam_sparepart',
        'usulan',
        'jam_mulai',
        'jam_selesai',
        'downtime',
        'diserahkan',
        'diterima',
        'status',
    ];
    public function mesins()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id');
    }
    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'diserahkan');
    }
}
