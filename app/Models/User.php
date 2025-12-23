<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    /*       **
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [

        'prof_id',
        'NIN',
        'name',
        'lastName',
        'birthDate',
        'address',
        'commune_id',
        'phone',
        'email',
        'username',
        'password',
        'status',
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
    protected $appends = ['fullname'];
    public function getFullNameAttribute()
    {
         return $this->name." ".$this->lastName ;
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthDate'=>'datetime',
            'password' => 'hashed',
        ];
    }
    public function farms()
    {
        return $this->hasMany(Farm::class, 'owner_id', 'NIN');
    } 
    public function guardedFarm()
    {
        return $this->hasOne(Farm::class, 'guardien_id');
    } 
    public  function rfidTags()
    {
        return $this->hasMany(Tag::class, 'owner_id');
    }
     public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

}