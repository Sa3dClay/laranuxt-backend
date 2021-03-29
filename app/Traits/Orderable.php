<?php

namespace App\Traits;

trait Orderable
{
    public function scopeLatestFirst($query) {
        $query->orderBy('created_at', 'desc');
    }

    public function scopeOldestFirst($query) {
        $query->orderBy('created_at', 'asc');
    }
}
