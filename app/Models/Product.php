<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['tenant_id', 'name', 'description', 'price', 'stock'];

    protected $casts = ['price' => 'decimal:2'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}

