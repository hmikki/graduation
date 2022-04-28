<?php

namespace App\Http\Requests\Admin\AppContent\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Admin;
//use App\Models\Media;
use App\Models\Attribute;
use App\Models\Media;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\OfferSizePrice;
use App\Models\OrderStatus;
use App\Models\RolePermission;
use App\Models\SizePrice;
use App\Traits\AhmedPanelTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
    public function preset($crud,$id){
        $Object = $crud->getEntity()->find($id);
        if(!$Object)
            return $crud->wrongData();
        foreach ($crud->getFields() as $field){
            if ($field['type'] == 'image'){
                if ( $this->hasFile($field['name'])){
                    $attribute_name = $field['name'];
                    $destination_path = "storage/media/";
                    $attribute_value = $field['name'];
                    // if a new file is uploaded, store it on disk and its filename in the database
                    if ($this->hasFile($attribute_name)) {
                        $file = $this->file($attribute_name);
                        if ($file->isValid()) {
                            $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                            $file->move($destination_path, $file_name);
                            $attribute_value =  $destination_path.$file_name;
                        }
                    }
                    $Object->{$field['name']} = $attribute_value;
                }
            }
            elseif ($field['type'] == 'multi_checkbox'){
                $MultiCheckboxField[] = $field;
            }
            elseif ($field['type'] == 'images'){
                $ImagesField[] = $field;
            }else {
                if ($this->filled($field['name'])){
                    $Object->{$field['name']} = $this->{$field['name']};
                }
            }
        }
        $Object->save();

        if(isset($MultiCheckboxField)){
            foreach ($MultiCheckboxField as $MField){
                $Model = $MField['custom']['RelationModel']['Model'];
                $Model->where($MField['custom']['RelationModel']['id'],$Object->getId())->delete();
                if ($this->filled($MField['name'])) {
                    if (is_array($this->{$MField['name']})) {
                        foreach ($this->{$MField['name']} as $MValue) {
                            $Model = $MField['custom']['RelationModel']['Model'];
                            $Model->{$MField['custom']['RelationModel']['ref_id']} = $MValue;
                            $Model->{$MField['custom']['RelationModel']['id']} = $Object->getId();
                            $Model->save();
                        }
                    }
                }
            }
        }
        if(isset($ImagesField)){
            foreach ($ImagesField as $IField){
                if($this->hasFile($IField['name'])){
                     foreach ($this->file($IField['name']) as $IValue){
                         $Model = new Media();
                         $Model->setFile($IValue);
                         $Model->setMediaType($IField['media_type']);
                         $Model->setRefId($Object->id);
                         $Model->save();
                     }
                }
            }
        }

        $Order_status = (new OrderStatus())->where('order_id',$Object->getId())->first();
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
                        return redirect()->back()->with('error', __('messages.wrong_sequence'));
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
                    $Object->setStatus($Order_status->getStatus());
                    $Object->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['InProgress']);
                    Functions::SendNotification($Object->user,'Order In Progress','Order In Progress !','الطلب قيد المراجعة !','طلبك قيد المراجعة',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Rejected']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InProgress']) {
                        return redirect()->back()->with('error', __('messages.wrong_sequence'));
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Rejected']);
                    // $Order_status->setRejectReason(@$this->reject_reason);
                    $Order_status->save();
                    $Object->setStatus($Order_status->getStatus());
                    $Object->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Rejected']);
                    Functions::SendNotification($Object->user,'Order Rejected','Provider Rejected your order !','الرفض على الطلب !','قام المزود برفض طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Accepted']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InProgress']) {
                        return redirect()->back()->with('error', __('messages.wrong_sequence'));
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['Accepted']);
                    $Order_status->save();
                    $Object->setStatus($Order_status->getStatus());
                    $Object->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Accepted']);
                    Functions::SendNotification($Object->user,'Order Accepted','Provider Accept your order !','قبول الطلب !','قام المزود بقبول طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['InDelivery']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['Accepted']) {
                        return redirect()->back()->with('error', __('messages.wrong_sequence'));
                    }
                    $Order_status->setStatus(Constant::ORDER_STATUSES['InDelivery']);
                    $Order_status->save();
                    $Object->setStatus($Order_status->getStatus());
                    $Object->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['InDelivery']);
                    Functions::SendNotification($Object->user,'Order In Delivery','Order In Delivery !','الطلب قيد التوصيل !','طلبك قيد التوصيل',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
                }
                case Constant::ORDER_STATUSES['Received']:{
                    if ($Order_status->getStatus() !=Constant::ORDER_STATUSES['InDelivery']) {
                        return redirect()->back()->with('error', __('messages.wrong_sequence'));
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
                    $Object->setStatus($Order_status->getStatus());
                    $Object->save();
                    Functions::ChangeOrderStatus($Order_status->getId(),Constant::ORDER_STATUSES['Received']);
                    Functions::SendNotification($Object->user,'Order Received','Customer Received the order !','تم استلام الطلب !','قام المزود بتسليم الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['General']);
                    break;
            }
            }

        if($crud->getLang() == 'Dashboard') {
            ModelRole::where('model_id',$Object->getId())->delete();
            ModelPermission::where('model_id',$Object->getId())->delete();
            if ($this->filled('roles')) {
                foreach ($this->roles as $role_id) {
                    $RolePermission = new ModelRole();
                    $RolePermission->setModelId($Object->getId());
                    $RolePermission->setRoleId($role_id);
                    $RolePermission->save();
                    foreach (RolePermission::where('role_id', $role_id)->get() as $Permission) {
                        $RolePermission = new ModelPermission();
                        $RolePermission->setModelId($Object->getId());
                        $RolePermission->setPermissionId($Permission->getPermissionId());
                        $RolePermission->save();
                    }
                }
            }
        }
        if($crud->getLang() == 'Dashboard' || $crud->getLang() == 'Role') {
            if($this->filled('permissions'))
            {
                if ($crud->getLang() == 'Dashboard'){
                    foreach ($this->permissions as $permission_id){
                        $RolePermission = new ModelPermission();
                        $RolePermission->setModelId($Object->getId());
                        $RolePermission->setPermissionId($permission_id);
                        $RolePermission->save();
                    }
                }
                if ($crud->getLang() == 'Role'){
                    foreach ($this->permissions as $permission_id){
                        $RolePermission = new RolePermission();
                        $RolePermission->setRoleId($Object->getId());
                        $RolePermission->setPermissionId($permission_id);
                        $RolePermission->save();
                    }
                }
            }
        }

        return redirect($crud->getRedirect())->with('status', __('dashboard.messages.saved_successfully'));
    }
}
