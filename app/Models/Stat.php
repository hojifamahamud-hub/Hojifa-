<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Stat extends Model
{
    protected $fillable = ['label_bn','label_en','value','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function label() { return t($this->label_bn, $this->label_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
