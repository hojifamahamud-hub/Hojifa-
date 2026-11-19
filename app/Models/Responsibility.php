<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Responsibility extends Model
{
    protected $fillable = ['title_bn','title_en','description_bn','description_en','icon','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function title() { return t($this->title_bn, $this->title_en); }
    public function description() { return t($this->description_bn, $this->description_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
