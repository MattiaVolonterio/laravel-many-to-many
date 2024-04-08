<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function get_technologies()
    {
        return implode(', ', $this->technologies->pluck('type')->toArray());
    }

    protected $fillable = [
        'title',
        'author',
        'description',
        'project_link',
        'type_id'
    ];
}
