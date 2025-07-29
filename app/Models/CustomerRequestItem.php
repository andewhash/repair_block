<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_request_id', 'item_number', 'brand_id', 'article', 
        'name', 'quantity', 'quality_type', 'price', 'delivery_days',
        'manufacturer_id', 'comment', 'file_path'
    ];

    public function request()
    {
        return $this->belongsTo(CustomerRequest::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
