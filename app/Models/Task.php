<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    public const STATUS_ASSIGNED = 'assigned';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_REVIEW = 'review';
    public const STATUS_COMPLETED = 'completed';
    protected $fillable = ['assignee_id','title','description','status','progress','due_date','completed_at','member_notes'];
    protected $casts = ['due_date' => 'date', 'completed_at' => 'datetime'];
    public function assignee() { return $this->belongsTo(User::class, 'assignee_id'); }
}
