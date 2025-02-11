<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table='payments';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'user_id',
        'booking_id',
        'email',
        'metode_pembayaran',
        'nomor_kartu',
        'total_pembayaran',
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

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
