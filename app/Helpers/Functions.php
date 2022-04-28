<?php


namespace App\Helpers;

use App\Mail\ForgetPasswordMail;
use App\Mail\VerificationMail;
use App\Mail\WelcomeMail;
use App\Models\Notification;
use App\Models\OrderStatus;
use App\Models\PasswordReset;
use App\Models\Transaction;
use App\Models\VerifyAccounts;
use App\Notifications\PasswordReset as PasswordResetNotification;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Mail;

class Functions
{
    use ResponseTrait;
    public static function SendNotification($user,$title,$msg,$title_ar,$msg_ar,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $user->device_token;

        $message = array
        (
            'body'  => ($user->getAppLocale() == 'en')?$msg:$msg_ar,
            'title' => ($user->getAppLocale() == 'en')?$title:$title_ar,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'to'        => $registrationIds,
            'notification'  => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            $notify = new Notification();
            $notify->type = $type;
            $notify->user_id = $user->id;
            $notify->title = $title;
            $notify->message = $msg;
            $notify->title_ar = $title_ar;
            $notify->message_ar = $msg_ar;
            $notify->ref_id = @$ref_id;
            $notify->save();
        }
        return true;
    }
    public static function SendNotifications($users,$title,$msg,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $users;
//        foreach ($users as $user){
//            $registrationIds[] = $user->device_token;
//
//        }

        $message = array
        (
            'body'  => $msg,
            'title' => $title,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'notification' => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            foreach ($users as $user){
                $notify = new Notification();
                $notify->type = $type;
                $notify->user_id = $user->id;
                $notify->title = $title;
                $notify->message = $msg;
                $notify->title_ar = $title;
                $notify->message_ar = $msg;
                $notify->ref_id = @$ref_id;
                $notify->save();
            }
        }
        return true;
    }
    public static function SendSms($msg,$to){
        $ch = curl_init();
        $userid = 'test';
        $password = 'test';
        $sender = 'test';
        $text = urlencode($msg);
        $encoding = 'UTF8';
        // auth call
        $url = "http://api.unifonic.com/wrapper/sendSMS.php?userid={$userid}&password={$password}&to={$to}&msg={$text}&sender={$sender}&encoding={$encoding}";
        $ret  = json_decode(file_get_contents($url), true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    public static function SendVerification($user,$type = null){
        if($type != null){
            switch ($type){
                case Constant::VERIFICATION_TYPE['Email']:{
                    if($user->email_verified_at != null)
                        return (new Functions)->failJsonResponse([__('auth.verified_before')]);
                    $code_email = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->id,'type'=>Constant::VERIFICATION_TYPE['Email']],
                        [
                            'user_id' => $user->id,
                            'code' => $code_email,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Email']
                        ]
                    );
                    Mail::to([$user->email])->send(new WelcomeMail());
                    break;
                }
                case Constant::VERIFICATION_TYPE['Mobile']:{
                    if($user->mobile_verified_at != null)
                        return (new Functions)->failJsonResponse([__('auth.mobile_verified_before')]);
                    $code_mobile = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->id,'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                        [
                            'user_id' => $user->id,
                            'code' => $code_mobile,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Mobile']
                        ]
                    );
                    static::SendSms('كود تفعيل الحساب هو : '.$code_mobile,$user->mobile);
                    break;
                }
            }
        }else{
            $code_email = rand( 10000 , 99999 );
            $code_mobile = rand( 10000 , 99999 );
            $token = Str::random(40).time();
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->id,'type'=>Constant::VERIFICATION_TYPE['Email']],
                [
                    'user_id' => $user->id,
                    'code' => $code_email,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Email']
                ]
            );
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->id,'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                [
                    'user_id' => $user->id,
                    'code' => $code_mobile,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Mobile']
                ]
            );
            static::SendSms('كود تفعيل الحساب هو : '.$code_mobile,$user->mobile);
            Mail::to([$user->email])->send(new WelcomeMail());
        }
        return (new Functions)->successJsonResponse( [__('auth.verification_code_sent')]);
    }
    public static function SendForget($user,$type = null){
        $code = rand( 10000 , 99999 );
        $token = Str::random(40).time();
        PasswordReset::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'code' => $code,
                'token' => $token,
            ]
        );
        if ($type == Constant::FORGET_TYPE['Mobile']) {
            static::SendSms('كود استرجاع كلمة المرور هو : '.$code,$user->mobile);
        }
        if ($type == Constant::FORGET_TYPE['Email']) {
            Mail::to($user)->send(new ForgetPasswordMail($code));
        }
    }
    public static function StoreImage($attribute_name,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        $request = Request::instance();
        if ($request->hasFile($attribute_name)) {
            $file = $request->file($attribute_name);
            if ($file->isValid()) {
                $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                $file->move($destination_path, $file_name);
                $attribute_value =  $destination_path.$file_name;
            }
        }
        return $attribute_value??null;
    }
    public static function StoreImageModel($file,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        if ($file->isValid()) {
            $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move($destination_path, $file_name);
            $attribute_value =  $destination_path.$file_name;
        }
        return $attribute_value??null;
    }
    public static function ChangeOrderStatus($OrderId,$Status){
        $OrderStatus = new OrderStatus();
        $OrderStatus->setOrderId($OrderId);
        $OrderStatus->setStatus($Status);
        $OrderStatus->save();
    }
    public static function UserBalance($user_id){
        $Deposits = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Deposit'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        $Withdraws = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Withdraw'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        $Holding = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Holding'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        return $Deposits - $Withdraws - $Holding;
    }
}
