<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed name_ar
 * @property mixed country_code
 * @property mixed coin_id
 * @property mixed flag
 * @property mixed delivery_cost
 * @property mixed tax
 * @property mixed product_id
 * @property boolean active
 */
class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name','name_ar','country_code', 'coin_id', 'flag','delivery_cost','tax', 'product_id','active'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class,'coin_id');
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
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name_ar
     */
    public function setNameAr($name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code): void
    {
        $this->country_code = $country_code;
    }

    /**
     * @return string
     */
    public function getCoinId(): string
    {
        return $this->coin_id;
    }

    /**
     * @param string $coin_id
     */
    public function setCoinId(string $coin_id): void
    {
        $this->coin_id = $coin_id;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return asset($this->flag)?asset($this->flag):null;
    }

    /**
     * @param string $flag
     */
    public function setImage(string $flag): void
    {
        $this->flag = Functions::StoreImageModel($flag,'country/flag');
    }

    /**
     * @return mixed
     */
    public function getDeliveryCost()
    {
        return $this->delivery_cost;
    }

    /**
     * @param mixed $delivery_cost
     */
    public function setDeliveryCost($delivery_cost): void
    {
        $this->delivery_cost = $delivery_cost;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     */
    public function setTax($tax): void
    {
        $this->tax = $tax;
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
