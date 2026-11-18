<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model
{
    protected $fillable = ['slug','title_bn','title_en','content_bn','content_en','meta_title_bn','meta_title_en','meta_desc_bn','meta_desc_en','active'];
    protected $casts = ['active' => 'boolean'];
}
