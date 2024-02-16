<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['name', 'slug'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public static function generateSlug($string)
    {
        return Str::slug($string, '-');
    }
}
