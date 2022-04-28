<?php

namespace App\Http\Requests\Admin\AppContent\Offer;

use App\Models\Admin;
//use App\Models\Media;
use App\Models\Attribute;
use App\Models\Media;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\OfferSizePrice;
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
        $sizes_prices[] = OfferSizePrice::where('product_id', $Object->getProductId())->delete();
        foreach ($this->size_name as $key=>$attr){
            $Model = new OfferSizePrice();
            //$Model->setId($this->id);
            $Model->setProductId($Object->getId());
            $Model->setSize($attr);
            $Model->setPrice($this->size_price[$key]);
            $Model->save();
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
