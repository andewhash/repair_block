<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['name'];
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    // Для подсчета пользователей
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}