<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = ['name', 'email'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
