<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\AdvertisementResource;
use App\Http\Resources\Api\Home\BrandResource;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\CityResource;
use App\Http\Resources\Api\Home\CountryResource;
use App\Http\Resources\Api\Home\SplashScreensResource;
use App\Http\Resources\Api\Order\CartResource;
use App\Models\Address;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Setting;
use App\Models\SplashScreen;
use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\Types\True_;

/**
 * @property mixed per_page
 */
class InstallRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function run(): JsonResponse
    {
        $Advertisements = AdvertisementResource::collection(Advertisement::where('active',true)->get());
        $Brands = BrandResource::collection(Brand::where('active',true)->get());
        $Countries = CountryResource::collection(Country::where('active',true)->get());
        $Cities = CityResource::collection(City::where('active',true)->get());
        $Categories = CategoryResource::collection(Category::where('active', true)->get());
        $SplashScreens = SplashScreensResource::collection(SplashScreen::where('active',true)->orderBy('order','desc')->get());
        $Settings = Setting::pluck((app()->getLocale() =='en')?'value':'value_ar','key')->toArray();
        return $this->successJsonResponse([],[
            'Brands'=>$Brands,
            'Advertisements'=>$Advertisements,
            'Countries'=>$Countries,
            'Cities'=>$Cities,
            'Categories'=> $Categories,
            'SplashScreens'=>$SplashScreens,
            'Settings'=>$Settings,
            'Essentials'=>[
                'UserTypes'=>Constant::USER_TYPE,
                'ForgetPasswordTypes'=>Constant::FORGET_TYPE,
                'VerificationTypes'=>Constant::VERIFICATION_TYPE,
                'NotificationTypes'=>Constant::NOTIFICATION_TYPE,
                'Quality' => Constant::QUALITY,
                'OrderStatus' => Constant::ORDER_STATUSES,
            ]
        ]);
    }
}
