<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeFilter(Builder $query): void
    {
        if ($title = request()->get('title')) {
            $query->where('title', 'like', '%' . $title . '%');
        }
    }
}
