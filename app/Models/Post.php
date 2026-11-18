<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    protected $fillable = ['title_bn','title_en','slug','category_bn','category_en','excerpt_bn','excerpt_en','content_bn','content_en','image','meta_title_bn','meta_title_en','meta_desc_bn','meta_desc_en','views','published_at','active'];
    protected $casts = ['active' => 'boolean', 'published_at' => 'datetime'];
    public function title() { return t($this->title_bn, $this->title_en); }
    public function excerpt() { return t($this->excerpt_bn, $this->excerpt_en); }
    public function content() { return t($this->content_bn, $this->content_en); }
    public function category() { return t($this->category_bn, $this->category_en); }
    public function metaTitle() { return t($this->meta_title_bn, $this->meta_title_en) ?: $this->title(); }
    public function metaDesc() { return t($this->meta_desc_bn, $this->meta_desc_en) ?: \Illuminate\Support\Str::limit(strip_tags($this->excerpt() ?? ''), 150); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
