<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Skill extends Model
{
    protected $fillable = ['name_bn','name_en','category_bn','category_en','level','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function name() { return t($this->name_bn, $this->name_en); }
    public function category() { return t($this->category_bn, $this->category_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
