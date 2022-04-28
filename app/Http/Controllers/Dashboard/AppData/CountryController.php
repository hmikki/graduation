<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Coin;
use App\Models\Country;
use App\Traits\AhmedPanelTrait;

class CountryController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/countries');
        $this->setEntity(new Country());
        $this->setTable('countries');
        $this->setLang('Country');
        $this->setColumns([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'tax'=> [
                'name'=>'tax',
                'type'=>'number',
                'is_searchable'=>true,
                'order'=>true
            ],
            'delivery_cost'=> [
                'name'=>'delivery_cost',
                'type'=>'number',
                'is_searchable'=>true,
                'order'=>true
            ],
            'flag'=> [
                'name'=>'flag',
                'type'=>'image',
                'is_searchable'=>true,
                'order'=>true
            ],
            'coin_id'=> [
                'name'=>'coin_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Coin::all(),
                    'custom'=>function($Object){
                        return ($Object)?(session('my_locale')=='ar'?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'coin'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'active'=> [
                'name'=>'active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'tax'=> [
                'name'=>'tax',
                'type'=>'number',
                'is_required'=>true
            ],
            'delivery_cost'=> [
                'name'=>'delivery_cost',
                'type'=>'number',
                'is_required'=>true
            ],
            'country_code'=> [
                'name'=>'country_code',
                'type'=>'text',
                'is_required'=>true
            ],
            'flag'=> [
                'name'=>'flag',
                'type'=>'image',
                'is_required'=>true,
                'is_required_update'=>false
            ],
            'coin_id'=> [
                'name'=>'coin_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Coin::all(),
                    'custom'=>function($Object){
                        return ($Object)?(session('my_locale')=='ar'?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'coin'
                ],
                'is_required'=>true
            ],
            'active'=> [
                'name'=>'active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }
}
