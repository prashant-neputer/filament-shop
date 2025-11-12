<?php

namespace App;

trait IsActive
{
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
