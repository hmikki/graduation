<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Http\Resources\Api\Product\SizePriceResource;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Discount;
use App\Models\DiscountHistory;
use App\Models\Media;
use App\Models\OfferSizePrice;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\SizePrice;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            //'product_id'=>'required|exists:products,id',
            'address_id' => 'required|exists:addresses,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'mobile' => 'required',
//            'discount_id' => 'required',
            'promocode' => 'nullable|exists:discounts,code',
            'status' => 'required',
//            'discount_amount' => '',
//            'amount' => 'required',
//            'tax' => 'required',
//            'delivery' => 'required',
//            'total' => 'required',


        ];
    }

    public function run(): JsonResponse
    {
        $logged = auth('api')->user();
        $Cart = Cart::where('user_id', $logged->id)->get();
        if(count($Cart) == 0 ){
            return $this->failJsonResponse([__('messages.empty_cart')]);

        }

        $Order =new  Order();
        $Order->setUserId($logged->getId());
        $Order->setName($logged->getName());
        $Order->setAddressId($this->address_id);
        $Order->setCountryId($this->country_id);
        $Order->setCityId($this->city_id);
        $Order->setAddress($this->address);
        $Order->setLat($this->lat);
        $Order->setLng($this->lng);
        $Order->setMobile($this->mobile);
        if (!empty($this->promocode)){
            $discount_row = Discount::where('code', $this->promocode)->first();
            $Order->setDiscountId($discount_row->id);
        }else{
            $Order->setDiscountId(null);
        }
        $Order->setDiscountAmount(0);
        $Order->setAmount(0);
        $Order->setTax(0);
        $Order->setDelivery(0);
        $Order->setTotal(0);
        $Order->setStatus(Constant::ORDER_STATUSES['New']);
        $Order->save();
        $total_amount = 0;

        foreach ($Cart as $object){
            $product_id = $object->product_id;
            $Product = (new Product())->find($product_id);
            $media = Media::where('ref_id', $product_id)->where('media_type', 1)->first();
            $offer_size_price = OfferSizePrice::where('product_id', $object->getProductId())->where('size', $object->getSize())->where('active', true)->first();
            $size_price = SizePrice::where('product_id', $object->getProductId())->where('size', $object->getSize())->first();

            if ($offer_size_price){
                $price = $offer_size_price->getPrice();
            }else{
                $price = $size_price->getPrice();
            }

            $Order_Product = new OrderProduct();
            $Order_Product->setOrderId($Order->getId());
            $Order_Product->setProductId($product_id);
            $Order_Product->setQuantity($object->quantity);
            $Order_Product->setName(app()->getLocale() == 'ar'?$Product->name_ar: $Product->name);
            $Order_Product->setDescription(app()->getLocale() == 'ar'?$Product->description_ar: $Product->description);
            $Order_Product->setQuality($Product->quality);
            $Order_Product->setPrice($price);
            $total = ($price) * ($object->quantity);
            $Order_Product->setTotal($total);
            $Order_Product->setSize($object->getSize());
            $Order_Product->setImage($media->getfile());
            $Order_Product->save();
            $object->delete();
            $total_amount +=$total;
        }
        if (!empty($this->promocode)) {
            $Discount = Discount::where('id', $Order->discount_id)->where('expire_at', '>', $Order->created_at)->first();
            if ($Discount) {
                $discount_amount = ((($total_amount * $Discount->rate) / 100) <= $Discount->limit) ? (($total_amount * $Discount->rate) / 100) : $Discount->limit;
                $use_limit_count = DiscountHistory::where('user_id', $logged->id)->where('discount_id', $Discount->id)->count();
                if ($use_limit_count < $Discount->use_limit) {
                    $Order->setDiscountAmount($discount_amount);
                    $Discount_History = new DiscountHistory();
                    $Discount_History->setUserId($logged->id);
                    $Discount_History->setOrderId($Order->id);
                    $Discount_History->setDiscountId($Order->discount_id);
                    $Discount_History->setValue($Order->discount_amount);
                    $Discount_History->save();
                } else {
                    $Order->setDiscountAmount(0);
                    //$Order->setDiscountId(null);
                }
            }
        }

        $Country = Country::find($Order->country_id);
        $Order->setAmount($total_amount);
        $Order->setDelivery($Country->delivery_cost);
        $Order->setTax($Country->tax);
        $Order_total = (($Order->amount) + ($Order->delivery) + ($Order->tax)) - ($Order->discount_amount);
        $Order->setTotal($Order_total);
        $Order->save();
        $order_status = new OrderStatus();
        $order_status->setOrderId($Order->getId());
        $order_status->setStatus(Constant::ORDER_STATUSES['New']);
        $order_status->save();
        return $this->successJsonResponse([__('messages.saved_successfully')],new OrderResource($Order),'Order');
    }
}
