<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Http\Resources\Api\Order\OrderStatusResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'order_id'=>'required|exists:orders,id',
            'status'=>'required|in:'.Constant::ORDER_STATUSES_RULES

        ];
    }

    public function run(): JsonResponse
    {
        $Object = (new Order())->find($this->order_id);
        $Order_status = (new OrderStatus())->where('order_id',$this->order_id)->first();
        if (auth()->guard('api')->check()){
            switch ($this->status){
                case Constant::ORDER_STATUSES['Canceled']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['New']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Canceled']);
                    //$Object->setCancelReason(@$this->cancel_reason);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Canceled']);
                    Functions::SendNotification($Object->user,'Order Canceled','Customer Canceled the order !','إلغاء الطلب !','قام المستخدم بإلغاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Received']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InDelivery']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    /* Transaction::where('ref_id',$Object->getId())->where('type',Constant::TRANSACTION_TYPES['Holding'])->where('user_id',$Object->getUserId())->update(['type'=>Constant::TRANSACTION_TYPES['Withdraw']]);
                     $Transaction = new Transaction();
                     $Transaction->setUserId($Object->getFreelancerId());
                     $Transaction->setRefId($Object->getId());
                     $Transaction->setType(Constant::TRANSACTION_TYPES['Deposit']);
                     $commission = (Setting::where('key','commission')->first())->getValue();
                     $commission = $Object->getTotal() * $commission /100;
                     $Transaction->setValue(($Object->getTotal()-$commission));
                     $Transaction->setStatus(Constant::TRANSACTION_STATUS['Paid']);
                     $Transaction->save();*/
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Received']);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Received']);
                    Functions::SendNotification($Object->user,'Order Received','Customer Received the order !','تم استلام الطلب !','قام المزود بتسليم الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
            }
        }
        elseif (auth()->guard('web')->check()){
            switch ($this->status){
                /*case Constant::ORDER_STATUSES['Canceled']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['New']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Canceled']);
                    //$Object->setCancelReason(@$this->cancel_reason);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Canceled']);
                    //Functions::SendNotification($Object->freelancer,'Order Canceled','Customer Canceled the order !','إلغاء الطلب !','قام المستخدم بإلغاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                    break;
                }*/
                case Constant::ORDER_STATUSES['InProgress']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['New']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    /*$Balance = Functions::UserBalance($Object->getUserId());
                    if ($Balance >= $Object->getTotal()) {
                        $Transaction = new Transaction();
                        $Transaction->setUserId($Object->getUserId());
                        $Transaction->setRefId($Object->getId());
                        $Transaction->setType(Constant::TRANSACTION_TYPES['Holding']);
                        $Transaction->setValue($Object->getTotal());
                        $Transaction->setStatus(Constant::TRANSACTION_STATUS['Paid']);
                        $Transaction->save();
                    }else{
                        return $this->failJsonResponse([__('messages.dont_have_credit')],[
                            'request_amount'=>($Object->getTotal()-$Balance)
                        ]);
                    }*/
                    $Order_status->setStatus(Constant::ORDER_STATUSES['InProgress']);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['InProgress']);
                    Functions::SendNotification($Object->user,'Order In Progress','Order In Progress !','الطلب قيد المراجعة !','طلبك قيد المراجعة',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Rejected']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InProgress']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Rejected']);
                    // $Order_status->setRejectReason(@$this->reject_reason);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Rejected']);
                    Functions::SendNotification($Object->user,'Order Rejected','Provider Rejected your order !','الرفض على الطلب !','قام المزود برفض طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Accepted']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InProgress']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Accepted']);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Accepted']);
                    Functions::SendNotification($Object->user,'Order Accepted','Provider Accept your order !','قبول الطلب !','قام المزود بقبول طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['InDelivery']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['Accepted']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['InDelivery']);
                    $Order_status->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['InDelivery']);
                    Functions::SendNotification($Object->user,'Order In Delivery','Order In Delivery !','الطلب قيد التوصيل !','طلبك قيد التوصيل',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                /*case Constant::ORDER_STATUSES['Received']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InDelivery']) {
                        return $this->failJsonResponse([__('messages.wrong_sequence')]);
                    }
                   /* Transaction::where('ref_id',$Object->getId())->where('type',Constant::TRANSACTION_TYPES['Holding'])->where('user_id',$Object->getUserId())->update(['type'=>Constant::TRANSACTION_TYPES['Withdraw']]);
                    $Transaction = new Transaction();
                    $Transaction->setUserId($Object->getFreelancerId());
                    $Transaction->setRefId($Object->getId());
                    $Transaction->setType(Constant::TRANSACTION_TYPES['Deposit']);
                    $commission = (Setting::where('key','commission')->first())->getValue();
                    $commission = $Object->getTotal() * $commission /100;
                    $Transaction->setValue(($Object->getTotal()-$commission));
                    $Transaction->setStatus(Constant::TRANSACTION_STATUS['Paid']);
                    $Transaction->save();*/
                /*$Order_status->setStatus(Constant::ORDER_STATUSES['Received']);
                $Order_status->save();
                Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Received']);
                //Functions::SendNotification($Object->freelancer,'Order Received','Customer Received the order !','تم استلام الطلب !','قام المزود باستلام الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }*/
            }
        }

        $Order_status->save();
        return $this->successJsonResponse([__('messages.updated_successful')],new OrderStatusResource($Order_status),'Order');
    }
}
