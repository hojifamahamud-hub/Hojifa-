<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ClientProject extends Model
{
    protected $fillable = ['user_id','title','description','category','budget','status','due_date'];
    protected $casts = ['due_date' => 'date', 'budget' => 'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}
