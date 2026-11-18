<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Visitor extends Model
{
    protected $fillable = ['email','ip','user_agent','source','visits','first_visited_at','last_visited_at'];
    protected $casts = ['first_visited_at' => 'datetime', 'last_visited_at' => 'datetime'];
}
