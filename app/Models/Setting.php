<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];
    protected $casts = ['value' => 'string'];
    public static function get(string $key, $default = null)
    {
        static $cache = [];
        if (!array_key_exists($key, $cache)) {
            $cache = array_column(self::all(['key', 'value'])->toArray(), 'value', 'key');
        }
        return $cache[$key] ?? $default;
    }
    public static function set(string $key, $value, string $group = 'general'): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
    }
}
