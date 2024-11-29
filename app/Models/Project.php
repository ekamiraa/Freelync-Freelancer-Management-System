<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'freelancer_id',
        'title',
        'desc',
        'status',
        'budget',
        'deadline'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_project');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'project_id');
    }
}
