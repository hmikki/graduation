<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\File\ASN1\Maps\Time;

/**
 * @property integer id
 * @property string name
 * @property string price
 * @property integer time
 */
class Coin extends Model
{
    protected $table = 'coins';
    protected $fillable = ['name','price','time'];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }



    /**
     * @return double
     */
    public function getPrice(): double
    {
        return $this->price;
    }

    /**
     * @param double $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }




    /**
     * @return Time
     */
    public function getTime(): Time
    {
        return $this->time;
    }

    /**
     * @param double $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }



}
