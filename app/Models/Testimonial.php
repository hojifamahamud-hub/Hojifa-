<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model
{
    protected $fillable = ['name','role','company','photo','text_bn','text_en','rating','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function text() { return t($this->text_bn, $this->text_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
