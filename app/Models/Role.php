<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasPermissions, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'guard_name',
        'board_id'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }


    /**
     * Метод для мягкого удаления роли с дополнительной логикой.
     *
     * @return void
     */
    public function softDelete()
    {
        // Дополнительная логика перед удалением, если нужна
        // Например, можно удалить или обновить связанные записи, связанные с этой ролью.

        $this->delete(); // Это выполнит soft delete
    }

    /**
     * Восстановление удалённой роли.
     *
     * @return void
     */
    public function restoreRole()
    {
        $this->restore(); // Это восстановит удалённую роль
    }

//    public function columns(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(LeedColumn::class, 'column_role', 'role_id', 'column_id');
//    }

    public function columns(): BelongsToMany
    {
        return $this->belongsToMany(LeedColumn::class, 'column_role', 'role_id', 'column_id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }


}
