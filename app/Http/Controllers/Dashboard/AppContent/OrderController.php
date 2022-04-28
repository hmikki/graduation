<?php

namespace App\Http\Controllers\Dashboard\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Dashboard\Controller;
use App\Http\Requests\Admin\AppContent\Order\AcceptRequest;
use App\Http\Requests\Admin\AppContent\Order\RejectRequest;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class OrderController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('dashboard/app_content/orders');
        if(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Doctor']) {
            $entity = User::where('status', Constant::ORDER_STATUSES['New']);
        }elseif(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Supervisor']){
            $entity = User::where('status', Constant::ORDER_STATUSES['Accepted']);
        }else{
            $entity = new User();
        }
        $this->setEntity($entity);
        $this->setTable('users');
        $this->setLang('Order');
        $this->setColumns([
            'student_id'=> [
                'name'=>'student_id',
                'type'=>'number',
                'is_searchable'=>true,
                'order'=>false
            ],
            'student_name'=> [
                'name'=>'student_name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'student_track'=> [
                'name'=>'student_track',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'section_number'=> [
                'name'=>'section_number',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'project_title'=> [
                'name'=>'project_title',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'project_type'=> [
                'name'=>'project_type',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'problem_description'=> [
                'name'=>'problem_description',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'solution_description'=> [
                'name'=>'solution_description',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>false
            ],
        ]);
        $this->SetLinks([
            'accept'=>[
                'route'=>'accept',
                'icon'=>'fa-check-square',
                'lang'=>__('crud.Order.accept',[],session('my_locale')),
                'condition'=>function ($Object){
                    if(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Doctor'] || auth('dashboard')->user()->getType() == Constant::USER_TYPE['Admin']){
                        return ($Object->status == Constant::ORDER_STATUSES['New']);

                    }elseif(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Supervisor'] || auth('dashboard')->user()->getType() == Constant::USER_TYPE['Admin']){
                        return ($Object->status == Constant::ORDER_STATUSES['Accepted']);
                    }
                }
            ],
            'reject'=>[
                'route'=>'reject',
                'icon'=>'fa-window-close',
                'lang'=>__('crud.Order.reject',[],session('my_locale')),
                'condition'=>function ($Object){
                    if(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Doctor'] || auth('dashboard')->user()->getType() == Constant::USER_TYPE['Admin']){
                        return ($Object->status == Constant::ORDER_STATUSES['New']);

                    }elseif(auth('dashboard')->user()->getType() == Constant::USER_TYPE['Supervisor'] || auth('dashboard')->user()->getType() == Constant::USER_TYPE['Admin']){
                        return ($Object->status == Constant::ORDER_STATUSES['Accepted']);
                    }
                }
            ],
            'delete',
        ]);
    }
    public function accept($id,AcceptRequest $request){
        return $request->preset($this, $id);
    }
    public function reject($id, RejectRequest $request){
        return $request->preset($this, $id);
    }
}
