<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    protected $fillable = ['invoice_id','method','amount','sender_number','trx_id','voucher_no','status','approved_at','admin_note'];
    protected $casts = ['amount' => 'decimal:2', 'approved_at' => 'datetime'];
    public function invoice() { return $this->belongsTo(Invoice::class); }
}
