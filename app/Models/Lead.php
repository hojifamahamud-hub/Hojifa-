<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model
{
    protected $fillable = ['type','name','email','phone','budget','timeline','message','meeting_type','preferred_date','status','admin_notes'];
    protected $casts = ['preferred_date' => 'date'];
    public const TYPE_CONSULT = 'consult';
    public const TYPE_REQUIREMENT = 'requirement';
    public const TYPE_MEETING = 'meeting';
    public const TYPE_NEWSLETTER = 'newsletter';
}
