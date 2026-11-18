<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    protected $fillable = ['title_bn','title_en','description_bn','description_en','icon','features','slug','sort','active'];
    protected $casts = ['features' => 'array', 'active' => 'boolean'];
    public function title() { return t($this->title_bn, $this->title_en); }
    public function description() { return t($this->description_bn, $this->description_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
