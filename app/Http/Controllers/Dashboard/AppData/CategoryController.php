<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Traits\AhmedPanelTrait;

class CategoryController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/categories');
        $this->setEntity(new Category());
        $this->setTable('categories');
        $this->setLang('Category');
        $this->setColumns([
            'brand_id'=> [
                'name'=>'brand_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Brand::all(),
                    'custom'=>function($Object){
                        return ($Object)?(session('my_locale')=='ar'?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'brand'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
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
            'brand_id'=> [
                'name'=>'brand_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Brand::all(),
                    'custom'=>function($Object){
                        return ($Object)?(session('my_locale')=='ar'?$Object->name_ar:$Object->name):'-';
                    },
                    'entity'=>'brand'
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
