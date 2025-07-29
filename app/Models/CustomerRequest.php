<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['subject', 'city_id', 'comment', 'file_path', 'user_id'];

    public function items()
    {
        return $this->hasMany(CustomerRequestItem::class);
    }

    public function responses()
    {
        return $this->hasMany(SellerResponse::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}