<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\SendsVkNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;
    use SendsVkNotifications;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_board_id',
        'phone_number',
        'telegram_id',
        'vk_id',
        'vk_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'vk_token' => 'encrypted',
    ];


    // Связь с досками (многие ко многим)
//    public function boards()
//    {
//        return $this->belongsToMany(Board::class)
//            ->withPivot('role_id');
//    }

    public function boardUser()
    {
        return $this->hasMany(BoardUser::class);
    }

    // Связь с доской (current_board)
    public function currentBoard()
    {
        return $this->belongsTo(Board::class, 'current_board_id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Домены, которыми управляет пользователь (администратор)
     */
    public function domains()
    {
        return $this->hasMany(Domain::class, 'admin_user_id');
    }

    /**
     * Отношение к новостям, которые пользователь создал
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'author_user_id');
    }

    /**
     * Отношение к опубликованным новостям
     */
    public function publishedNews(): HasMany
    {
        return $this->news()->published();
    }

    // В модели User добавляем:
    public function boardSettings(): HasMany
    {
        return $this->hasMany(BoardUserSetting::class);
    }




}
