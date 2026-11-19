<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Faq extends Model
{
    protected $fillable = ['question_bn','question_en','answer_bn','answer_en','sort','active'];
    protected $casts = ['active' => 'boolean'];
    public function question() { return t($this->question_bn, $this->question_en); }
    public function answer() { return t($this->answer_bn, $this->answer_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
