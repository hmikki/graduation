<?php

namespace App\Http\Controllers\Dashboard\AppData;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\SplashScreen;
use App\Traits\AhmedPanelTrait;

class SplashScreenController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_data/splash_screens');
        $this->setEntity(new SplashScreen());
        $this->setTable('splash_screens');
        $this->setLang('SplashScreen');
        $this->setColumns([
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_searchable'=>false,
                'order'=>false
            ],
            'title'=> [
                'name'=>'title',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'title_ar'=> [
                'name'=>'title_ar',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'order'=> [
                'name'=>'order',
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
            'title'=> [
                'name'=>'title',
                'type'=>'text',
                'is_required'=>true
            ],
            'title_ar'=> [
                'name'=>'title_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'description'=> [
                'name'=>'description',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'description_ar'=> [
                'name'=>'description_ar',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'order'=> [
                'name'=>'order',
                'type'=>'number',
                'is_required'=>true
            ],
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_required'=>false,
                'is_required_update'=>false
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
