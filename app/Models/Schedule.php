<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'nama_maskapai',
        'tanggal_berangkat',
        'tanggal_sampai',
        'waktu_berangkat',
        'waktu_sampai',
        'bandara_asal',
        'bandara_tujuan',
        'kursi_tersedia',
        'harga_per_kursi',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }
}
