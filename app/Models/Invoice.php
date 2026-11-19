<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model
{
    public const STATUS_UNPAID = 'unpaid';
    public const STATUS_PARTIAL = 'partial';
    public const STATUS_PAID = 'paid';
    protected $fillable = ['user_id','client_project_id','number','amount','paid_amount','currency','status','note','due_date'];
    protected $casts = ['amount' => 'decimal:2', 'paid_amount' => 'decimal:2', 'due_date' => 'date'];
    public function user() { return $this->belongsTo(User::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function clientProject() { return $this->belongsTo(ClientProject::class); }
    public function getDueAttribute(): float
    {
        return max(0, (float)$this->amount - (float)$this->paid_amount);
    }
}
