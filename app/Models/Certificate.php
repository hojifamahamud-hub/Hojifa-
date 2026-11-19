<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Certificate extends Model
{
    protected $fillable = ['title_bn','title_en','issuer','image','url','issued_at','sort','active'];
    protected $casts = ['active' => 'boolean', 'issued_at' => 'date'];
    public function title() { return t($this->title_bn, $this->title_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
