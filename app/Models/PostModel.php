<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'postID';
    protected $fillable = [
        'title',
        'thumnail',
        'admin_id',
        'content'
    ];
    public $timestamps =false;
}
