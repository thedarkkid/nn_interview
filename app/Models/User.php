<?php

namespace App\Models;

use App\helpers\FilterField;
use App\traits\CanFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'age',
        'excerpt',
        'email',
        'password',
    ];

    /**
     * @var FilterField[]
     */
    protected static $filterFields = [
        ["column" => "firstname", "comparator" => "LIKE", "field" => "_firstname"],
        ["column" => "lastname", "comparator" => "LIKE", "field" => "_lastname"],
        ["column" => "email", "comparator" => "LIKE", "field" => "_email"],
        ["column" => "id", "comparator" => "=", "field" => "_key"],
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Notes relation;
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }


}
