<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

/**
 * @property mixed id
 * @property mixed email
 * @property mixed student_id
 * @property mixed student_name
 * @property mixed student_track
 * @property mixed section_number
 * @property mixed project_title
 * @property mixed project_type
 * @property mixed problem_description
 * @property mixed solution_description
 * @property mixed status
 * @property mixed password
 * @property mixed email_verified_at
 * @property mixed mobile_verified_at
 * @property mixed app_locale
 * @property mixed device_type
 * @property mixed device_token
 * @property boolean active
 */
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = ['student_name','email','student_id', 'student_track', 'section_number', 'project_title','project_type','problem_description','solution_description','status','password','email_verified_at','mobile_verified_at','app_locale' ,'device_type','device_token','active',];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime','mobile_verified_at' => 'datetime'];


    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
        static::deleting(function($Object) {
            foreach ($Object->notifications as $notification) {
                $notification->delete();
            };
        });
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function getImageAttribute($value): ?string
    {
        return ($value)?asset($value):null;
    }
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = Functions::StoreImageModel($value,'users/image');
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
     * @return mixed
     */
    public function getAppLocale(): ?string
    {
        return $this->app_locale;
    }

    /**
     * @param mixed $app_locale
     */
    public function setAppLocale($app_locale): void
    {
        $this->app_locale = $app_locale;
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
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * @param mixed $student_id
     */
    public function setStudentId($student_id): void
    {
        $this->student_id = $student_id;
    }

    /**
     * @return mixed
     */
    public function getStudentName()
    {
        return $this->student_name;
    }

    /**
     * @param mixed $student_name
     */
    public function setStudentName($student_name): void
    {
        $this->student_name = $student_name;
    }


    /**
     * @return mixed
     */
    public function getStudentTrack()
    {
        return $this->student_track;
    }

    /**
     * @param mixed $student_track
     */
    public function setStudentTrack($student_track): void
    {
        $this->student_track = $student_track;
    }

    /**
     * @return mixed
     */
    public function getSectionNo()
    {
        return $this->section_number;
    }

    /**
     * @param mixed $section_number
     */
    public function setSectionNo($section_number): void
    {
        $this->section_number = $section_number;
    }

    /**
     * @return mixed
     */
    public function getProjectTitle()
    {
        return $this->project_title;
    }

    /**
     * @param mixed $project_title
     */
    public function setProjectTitle($project_title): void
    {
        $this->project_title = $project_title;
    }

    /**
     * @return mixed
     */
    public function getProjectType()
    {
        return $this->project_type;
    }

    /**
     * @param mixed $project_type
     */
    public function setProjectType($project_type): void
    {
        $this->project_type = $project_type;
    }

    /**
     * @return mixed
     */
    public function getProblem()
    {
        return $this->problem_description;
    }

    /**
     * @param mixed $problem_description
     */
    public function setProblem($problem_description): void
    {
        $this->problem_description = $problem_description;
    }

    /**
     * @return mixed
     */
    public function getSolution()
    {
        return $this->solution_description;
    }

    /**
     * @param mixed $solution_description
     */
    public function setSolution($solution_description): void
    {
        $this->solution_description = $solution_description;
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
    public function getEmailVerifiedAt()
    {
        return $this->email_verified_at;
    }

    /**
     * @param mixed $email_verified_at
     */
    public function setEmailVerifiedAt($email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    /**
     * @return mixed
     */
    public function getMobileVerifiedAt()
    {
        return $this->mobile_verified_at;
    }

    /**
     * @param mixed $mobile_verified_at
     */
    public function setMobileVerifiedAt($mobile_verified_at): void
    {
        $this->mobile_verified_at = $mobile_verified_at;
    }


    /**
     * @return mixed
     */
    public function getDeviceType()
    {
        return $this->device_type;
    }

    /**
     * @param mixed $device_type
     */
    public function setDeviceType($device_type): void
    {
        $this->device_type = $device_type;
    }

    /**
     * @return mixed
     */
    public function getDeviceToken()
    {
        return $this->device_token;
    }

    /**
     * @param mixed $device_token
     */
    public function setDeviceToken($device_token): void
    {
        $this->device_token = $device_token;
    }

    /**
     * @return mixed
     */
    public function getstatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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

}
