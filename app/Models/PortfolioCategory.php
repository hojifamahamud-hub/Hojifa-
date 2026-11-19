<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PortfolioCategory extends Model
{
    protected $fillable = ['name_bn','name_en','slug','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function projects() { return $this->hasMany(Project::class); }
    public function name() { return t($this->name_bn, $this->name_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
