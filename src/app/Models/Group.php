<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Group extends Model {
    use HasFactory;

    protected $table = 'group';
    protected $fillable = ['title', 'description'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
