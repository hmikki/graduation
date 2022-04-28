<?php

namespace App\Http\Requests\Admin\AppContent\Offer;

//use App\Models\Media;
use App\Models\Attribute;
use App\Models\Media;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\OfferSizePrice;
use App\Models\Product;
use App\Models\RolePermission;
use App\Models\SizePrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class StoreRequest extends FormRequest
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

    public function preset($crud)
    {
        $Object = $crud->getEntity();
        foreach ($crud->getFilters() as $filter){
            if ($filter['type'] == 'where'){
                $Object->{$filter['name']} = $filter['value'];
            }
            elseif ($filter['type'] == 'whereNull'){
                $Object->{$filter['name']} = null;
            }
            elseif ($filter['type'] == 'whereNotNull'){
                $Object->{$filter['name']} = null;
            }
        }
        foreach ($crud->getFields() as $field) {
            if ($field['type'] == 'image' || $field['type'] == 'file' ){
                if($this->hasFile($field['name'])){
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
                if ($this->filled($field['name'])) {
                    $Object->{$field['name']} = $this->{$field['name']};
                }
            }
        }
        $Object->save();
        $Object->refresh();
        if(isset($ImagesField)){
            foreach ($ImagesField as $IField){
                foreach ($this->file($IField['name']) as $IValue){
                    $Model = new Media();
                    $Model->setFile($IValue);
                    $Model->setMediaType($IField['media_type']);
                    $Model->setRefId($Object->id);
                    $Model->save();
                }
            }
        }
        foreach ($this->size_name as $key=>$attr){
            $Model = new OfferSizePrice();
            //$Model->setId($this->id);
            $Model->setProductId($Object->getId());
            $Model->setSize($attr);
            $Model->setPrice($this->size_price[$key]);
            $Model->save();
        }
        return redirect($crud->getRedirect())->with('status', __('dashboard.messages.saved_successfully'));
    }
}
