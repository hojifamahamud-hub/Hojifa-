<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model
{
    protected $fillable = ['type','name','email','phone','budget','timeline','message','status','admin_notes'];
    public const TYPE_CONSULT = 'consult';
    public const TYPE_REQUIREMENT = 'requirement';
}
