<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['metadata' => 'array', 'status_changed_at' => 'datetime'];

    public function customer() { return $this->belongsTo(User::class, 'user_id'); }
    public function service() { return $this->belongsTo(Service::class); }
    public function details() { return $this->hasMany(OrderDetail::class); }
    public function payment() { return $this->hasOne(Payment::class); }
    public function logs() { return $this->hasMany(OrderStatusLog::class); }
}
