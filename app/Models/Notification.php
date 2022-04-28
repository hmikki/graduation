<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property mixed id
 * @property mixed user_id
 * @property mixed title
 * @property mixed message
 * @property mixed title_ar
 * @property mixed message_ar
 * @property mixed ref_id
 * @property mixed type
 * @property mixed read_at
 * @method Notification find(int $id)
 */
class Notification extends Model
{

    protected $table = 'notifications';

    protected $fillable = [ 'user_id','title','message','title_ar','message_ar','ref_id','type','read_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    const TYPE = [
        'General'=>0,
    ];

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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitleAr()
    {
        return $this->title_ar;
    }

    /**
     * @param mixed $title_ar
     */
    public function setTitleAr($title_ar): void
    {
        $this->title_ar = $title_ar;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessageAr()
    {
        return $this->message_ar;
    }

    /**
     * @param mixed $message_ar
     */
    public function setMessageAr($message_ar): void
    {
        $this->message_ar = $message_ar;
    }

    /**
     * @return mixed
     */
    public function getRefId()
    {
        return $this->ref_id;
    }

    /**
     * @param mixed $ref_id
     */
    public function setRefId($ref_id): void
    {
        $this->ref_id = $ref_id;
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
     * @return mixed
     */
    public function getReadAt()
    {
        return $this->read_at;
    }

    /**
     * @param mixed $read_at
     */
    public function setReadAt($read_at): void
    {
        $this->read_at = $read_at;
    }

}
