<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'user_id',
        'device_id',
        'device_name',
        'platform',
        'is_biometric_enabled',
        'last_login_at',
        'ip_address',
        'is_active'
    ];

    protected $dates = [
        'last_login_at',
        'created_at',
        'updated_at'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope to find a device by device_id
    public function scopeFindByDeviceId($query, $deviceId)
    {
        return $query->where('device_id', $deviceId);
    }

}
