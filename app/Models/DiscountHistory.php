<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property mixed id
 * @property mixed user_id
 * @property mixed order_id
 * @property mixed discount_id
 * @property mixed value
 */
class DiscountHistory extends Model
{
    protected $table = 'discounts_history';
    protected $fillable = ['user_id','order_id','discount_id','value',];

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
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getDiscountId()
    {
        return $this->discount_id;
    }

    /**
     * @param mixed $discount_id
     */
    public function setDiscountId($discount_id): void
    {
        $this->discount_id = $discount_id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

}
