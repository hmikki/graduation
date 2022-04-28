<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Admin\Home\DeleteMediaRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index(){
        return view('AhmedPanel.home');
    }
    public function lang(){
        if(session('my_locale','en') =='en'){
            session(['my_locale' => 'ar']);
        }else{
            session(['my_locale' => 'en']);
        }
        App::setLocale(session('my_locale'));
        return redirect()->back();
    }
    public function general_notification(Request $request){
        $Title = $request->has('title')?$request->title:'';
        $Message = $request->has('msg')?$request->msg:'';
        $Users = new User();
        if ($request->filled('user_id')){
            $Users = $Users->where('id',$request->user_id);
        }
        $Users = $Users->whereNotNull('device_token')->pluck('device_token')->toArray();
        $UsersChunks=array_chunk($Users,1000);
        foreach ($UsersChunks as $UsersChunk){
            Functions::sendNotifications($UsersChunk,$Title,$Message,null,Constant::NOTIFICATION_TYPE['General'],false);
        }
        return redirect()->back()->with('status', __('admin.messages.notification_sent'));
    }
    public function delete_media(DeleteMediaRequest $request){
        return $request->preset();
    }
}
