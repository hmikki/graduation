<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed password
 * @property mixed type
 * @property mixed remember_token
 * @property boolean active
 * @property mixed image
 */
class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [ 'name','email','password', 'type','remember_token','active','image'];
    protected $hidden = ['password', 'remember_token',];

    /**
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(ModelRole::class,'model_id','id');
    }
    /**
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(ModelPermission::class,'permission_id','id');
    }
    /**
     * @param $id
     * @return bool
     */
    public function hasRole($id): bool{
        return (bool)ModelRole::where('model_id', $this->getId())->where('role_id', $id)->first();
    }
    /**
     * @param $id
     * @return bool
     */
    public function hasPermission($id): bool{
        return (bool)ModelPermission::where('model_id', $this->getId())->where('permission_id', $id)->first();
    }

    /**
     * @param iterable|string $ability
     * @param array $arguments
     * @return bool
     */
    public function can($ability, $arguments = []): bool
    {
        $Permission = Permission::where('key',$ability)->first();
        if(!$Permission)
            return true;
        return $this->hasPermission($Permission->getId());
    }
    public function login_history(): HasMany
    {
        return $this->hasMany(Log::class,'user_id')->where('type',Log::$Type['Login']);
    }
    public function last_login(){
        return ($this->login_history()->orderBy('created_at','desc')->first())?$this->login_history()->orderBy('created_at','desc')->first()->created_at:'';
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param mixed $remember_token
     */
    public function setRememberToken($remember_token): void
    {
        $this->remember_token = $remember_token;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

}
