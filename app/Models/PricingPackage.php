<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PricingPackage extends Model
{
    protected $fillable = ['name_bn','name_en','price','unit_bn','unit_en','description_bn','description_en','features','badge_bn','badge_en','featured','sort','active'];
    protected $casts = ['features' => 'array', 'featured' => 'boolean', 'active' => 'boolean'];
    public function name() { return t($this->name_bn, $this->name_en); }
    public function unit() { return t($this->unit_bn, $this->unit_en); }
    public function description() { return t($this->description_bn, $this->description_en); }
    public function badge() { return t($this->badge_bn, $this->badge_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
