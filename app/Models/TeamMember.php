<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model
{
    protected $fillable = ['name','role_bn','role_en','photo','bio_bn','bio_en','email','phone','socials','sort','active'];
    protected $casts = ['socials' => 'array', 'active' => 'boolean'];
    public function role() { return t($this->role_bn, $this->role_en); }
    public function bio() { return t($this->bio_bn, $this->bio_en); }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
