<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';
    public const ROLE_CLIENT = 'client';
    protected $fillable = ['name','email','password','role','status','phone','skills','avatar'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', 'skills' => 'array'];
    public function isAdmin(): bool { return $this->role === self::ROLE_ADMIN; }
    public function isMember(): bool { return $this->role === self::ROLE_MEMBER; }
    public function isClient(): bool { return $this->role === self::ROLE_CLIENT; }
    public function isActive(): bool { return $this->status === 'active'; }
    public function tasks() { return $this->hasMany(Task::class, 'assignee_id'); }
    public function clientProjects() { return $this->hasMany(ClientProject::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function conversations() { return $this->hasMany(Conversation::class); }
}
