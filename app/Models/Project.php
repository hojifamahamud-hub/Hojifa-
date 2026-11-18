<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    protected $fillable = ['portfolio_category_id','title_bn','title_en','slug','client','description_bn','description_en','before_after','metrics','live_url','featured','sort','active'];
    protected $casts = ['before_after' => 'array', 'metrics' => 'array', 'featured' => 'boolean', 'active' => 'boolean'];
    public function category() { return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id'); }
    public function images() { return $this->hasMany(ProjectImage::class); }
    public function title() { return t($this->title_bn, $this->title_en); }
    public function description() { return t($this->description_bn, $this->description_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
