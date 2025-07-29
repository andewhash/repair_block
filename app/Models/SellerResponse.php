<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['customer_request_id', 'user_id', 'response_text', 'file_path', 'responded_items', 'status'];

    public function request()
    {
        return $this->belongsTo(CustomerRequest::class, 'customer_request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'responded_items' => 'array'
    ];
}