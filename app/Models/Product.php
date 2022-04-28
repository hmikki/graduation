<?php

namespace App\Models;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed id
 * @property mixed brand_id
 * @property mixed name
 * @property mixed description
 * @property mixed product_no
 * @property mixed name_ar
 * @property mixed description_ar
 * @property mixed quality
 * @property mixed country_id
 * @property mixed attribute_id
 * @property mixed size_price_id
 * @property boolean active
 */
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','description', 'product_no', 'name_ar','description_ar','quality', 'country_id','brand_id','size_price_id', 'attribute_id', 'active'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function orders_products():HasMany
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class, 'product_id');
    }
    public function size_price(): HasMany
    {
        return $this->hasMany(SizePrice::class, 'product_id');
    }
    public function media(): HasMany
    {
        return $this->hasMany(Media::class,'ref_id')->where('media_type',Constant::MEDIA_TYPE['Product']);
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
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * @param mixed $brand_id
     */
    public function setBrandId($brand_id): void
    {
        $this->brand_id = $brand_id;
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
    public function getProductNo()
    {
        return $this->product_no;
    }

    /**
     * @param mixed $product_no
     */
    public function setProductNo($product_no): void
    {
        $this->product_no = $product_no;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
    public function getDescriptionAr()
    {
        return $this->description_ar;
    }

    /**
     * @param mixed $description_ar
     */
    public function setDescriptionAr($description_ar): void
    {
        $this->description_ar = $description_ar;
    }

    /**
     * @return mixed
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     */
    public function setQuality($quality): void
    {
        $this->quality = $quality;
    }

    /**
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param mixed $country_id
     */
    public function setCountryId($country_id): void
    {
        $this->country_id = $country_id;
    }

    /**
     * @return mixed
     */
    public function getAttributeId()
    {
        return $this->attribute_id;
    }

    /**
     * @param mixed $attribute_id
     */
    public function setAttributeId($attribute_id): void
    {
        $this->attribute_id = $attribute_id;
    }

    /**
     * @return mixed
     */
    public function getSizePriceId()
    {
        return $this->size_price_id;
    }

    /**
     * @param mixed $size_price_id
     */
    public function setSizePriceId($size_price_id): void
    {
        $this->size_price_id = $size_price_id;
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
