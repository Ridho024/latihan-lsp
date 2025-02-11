<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    public $table = 'bookings';
    public $incrementing = false;
    public $keyType = 'string';
    
    protected $fillable = [
        'user_id',
        'schedule_id',
        'jumlah_kursi',
        'total_harga',
        'status',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * @return BelongsTo
     */
    public function schedule():BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
