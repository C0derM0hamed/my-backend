<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['input_schema' => 'array', 'is_active' => 'boolean', 'requires_input' => 'boolean'];
    public function images() { return $this->hasMany(ServiceImage::class); }
}
