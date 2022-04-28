<?php


namespace App;


use App\Models\Attachment;
use App\Models\Notification;

class Master
{
    public static function NiceNames($Model){
        switch ($Model){
            case 'User':
                return [
                    'name'=>__('names.users.name'),
                    'email'=>__('names.users.email'),
                    'mobile'=>__('names.users.mobile'),
                    'password'=>__('names.users.password'),
                    'old_password'=>__('names.users.old_password'),
                    'password_confirmation'=>__('names.users.password_confirmation'),
                    'address'=>__('names.users.address'),
                    'city_id'=>__('names.users.city_id'),
                    'gender'=>__('names.users.gender'),
                    'dob'=>__('names.users.dob'),
                    'type'=>__('names.users.type'),
                    'verified_at'=>__('names.users.verified_at'),
                    'device_token'=>__('names.users.device_token'),
                    'device'=>__('names.users.device'),
                    'verification_code'=>__('names.users.verification_code'),
                    'is_active'=>__('names.users.is_active'),
                ];
            case 'Order':
                return [
                    'title'=>__('names.advertisements.title'),
                    'description'=>__('names.advertisements.description'),
                    'category_id'=>__('names.advertisements.category_id'),
                    'city_id'=>__('names.advertisements.city_id'),
                    'image'=>__('names.advertisements.image'),
                    'message'=>__('names.advertisements.message'),
                    'stars'=>__('names.advertisements.stars'),
                    'sub_category_id'=>__('names.advertisements.sub_category_id'),
                ];
            case 'Comment':
                return [
                    'comment'=>__('names.comments.comment'),
                ];
            case 'Favourite':
                return [
                    'place_id'=>__('names.favourites.place_id'),
                ];
            case 'Offer':
                return [
                    'Offer'=>__('names.favourites.place_id'),
                ];
            default :
                [];
        }

    }

    public static function Upload($attribute_name, $destination_path,$value = null){
        if($value){
            // 1. Generate a new file name
            $file = $value;
            $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            // 2. Move the new file to the correct path
            $file_path = $file->move($destination_path, $new_file_name);
            // 3. Save the complete path to the database
            return $destination_path.$new_file_name;
        }
        else{
            $request = \Request::instance();
            // if a new file is uploaded, store it on disk and its filename in the database
            if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
                // 1. Generate a new file name
                $file = $request->file($attribute_name);
                $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                // 2. Move the new file to the correct path
                $file_path = $file->move($destination_path, $new_file_name);
                // 3. Save the complete path to the database
                return $destination_path.$new_file_name;
            }
            return false;
        }
    }
    public static function MultiUpload($attribute_name, $destination_path,$ref_id,$type=1){
        $request = \Request::instance();
        $destination_path = $destination_path.'/';

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name)) {
            $file = $request->file($attribute_name);

            if(is_array($file)){
                foreach ($file as $item){
                    // 1. Generate a new file name
                    $new_file_name = md5($item->getClientOriginalName().time()).'.'.$item->getClientOriginalExtension();
                    // 2. Move the new file to the correct path
                    $file_path = $item->move($destination_path, $new_file_name);
                    // 3. Save the complete path to the database
                    Attachment::create(array('ref_id'=>$ref_id,'type'=>$type,'attachment'=>$destination_path.$new_file_name));
                }
                return true;
            }else{
                // 1. Generate a new file name
                $file = $request->file($attribute_name);
                $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                // 2. Move the new file to the correct path
                $file_path = $file->move($destination_path, $new_file_name);
                // 3. Save the complete path to the database
                return $destination_path.$new_file_name;
            }
        }
        return false;
    }
    public static function SocialLogin($Provider,$Token){
        switch ($Provider){
            case 'google':{
                $User = [];
                $smsUrl = 'https://oauth2.googleapis.com/tokeninfo?id_token='.$Token;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$smsUrl);
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result,true);
                if (isset($result['error']))
                    return null;
                $User['provider_id'] = @$result['sub'];
                $User['name'] = @$result['name'];
                $User['email'] = @$result['email'];
                return $User;
            }
            case 'facebook':{
                $Fields = 'email%2Cname';
                $smsUrl = 'https://graph.facebook.com/v4.0/me?access_token='.$Token.'&fields='.$Fields.'';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$smsUrl);
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result,true);
                if (isset($result['error']))
                    return null;
                $User['provider_id'] = @$result['id'];
                $User['name'] = @$result['name'];
                $User['email'] = @$result['email'];
                return $User;
            }
            default:{
                return null;
            }
        }
    }

    public static function ExportPDF($Objects, $view, $names, $Columns, $save = false, $path = '')
    {
        $html = view($view, compact('Objects', 'names','Columns'))->render();
        try {
            $mpdf = new \Mpdf\Mpdf([
                'default_font' => 'frutiger',
                'tempDir' => __DIR__ . '/tmp',
                // 'orientation' => 'A4'
            ]);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle($names);
            $mpdf->autoScriptToLang = true;
            $mpdf->baseScript = 1;
            $mpdf->autoVietnamese = true;
            $mpdf->autoArabic = true;
            $mpdf->autoLangToFont = true;
            $mpdf->showImageErrors = true;
            $mpdf->SetDirectionality('rtl');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            if ($save) {
                $mpdf->Output($path, 'F');
            } else {
                $mpdf->Output($names.'-'.now(). '.pdf', 'D');
            }
        } catch (MpdfException $e) {
            return redirect()->back()->with('error','Error : '.$e->getMessage());
        }
    }

    public static function SendNotification($user_id,$token, $title,$msg,$ref_id = null,$type= 0,$store = true)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $token;


        $message = array
        (
            'body'  => $msg,
            'title' => $title,
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
            $notify->user_id = $user_id;
            $notify->title = $title;
            $notify->message = $msg;
            $notify->ref_id = @$ref_id;
            $notify->save();
        }
        return true;
    }

    public static function Columns($column,$object){
        switch ($column['type']){
            case 'datetime':
                return view('ahmedmelhalaby.base.columns.datetime',compact('column','object'));
                break;
            case 'relation':
                return view('ahmedmelhalaby.base.columns.relation',compact('column','object'));
                break;
            case 'is_active':
                return view('ahmedmelhalaby.base.columns.activation',compact('column','object'));
                break;
            case 'email':
                return view('ahmedmelhalaby.base.columns.email',compact('column','object'));
                break;
            case 'select':
                return view('ahmedmelhalaby.base.columns.select',compact('column','object'));
                break;
            case 'image':
                return view('ahmedmelhalaby.base.columns.image',compact('column','object'));
                break;
            case 'text':
            default :
                return view('ahmedmelhalaby.base.columns.default',compact('column','object'));
                break;
        }
    }

    public static function Links($link,$object,$redirect){
        switch($link){
            case 'show' :
                return view('ahmedmelhalaby.base.links.show',compact('link','object','redirect'));
                break;
            case 'edit' :
                return view('ahmedmelhalaby.base.links.edit',compact('link','object','redirect'));
                break;
            case 'activation' :
                return view('ahmedmelhalaby.base.links.activation',compact('link','object','redirect'));
                break;
            case 'change_password' :
                return view('ahmedmelhalaby.base.links.change_password',compact('link','object','redirect'));
                break;
            case 'delete' :
                return view('ahmedmelhalaby.base.links.delete',compact('link','object','redirect'));
                break;
        }
    }

    public static function SearchAppends($Columns){
        $array = [
            'q' => request()->q,
            'order_by' => request()->order_by,
            'order_type' => request()->order_type,
        ];
        foreach($Columns as $Column)
            if($Column['is_searchable'])
                $array[$Column['name']] = request($Column['name']);
        return $array;
    }

    public static function SearchColumns($Column){
        if($Column['is_searchable'])
            switch ($Column['type']){
                case 'is_active':
                    return view('ahmedmelhalaby.base.search.activation',compact('Column'));
                    break;
                case 'relation':
                    return view('ahmedmelhalaby.base.search.relation',compact('Column'));
                    break;
                case 'datetime':
                    return view('ahmedmelhalaby.base.search.datetime',compact('Column'));
                    break;
                case 'select':
                    return view('ahmedmelhalaby.base.search.select',compact('Column'));
                    break;
                case 'text':
                case 'email':
                    return view('ahmedmelhalaby.base.search.default',compact('Column'));
                    break;
                default :
                    return '';
            }
        else
            return '';
    }

    public static function Fields($Field,$value){
        switch ($Field['type']){
            case 'relation':
                return view('ahmedmelhalaby.base.fields.relation',compact('Field','value'));
                break;
            case 'datetime':
                return view('ahmedmelhalaby.base.fields.datetime',compact('Field','value'));
                break;
            case 'time':
                return view('ahmedmelhalaby.base.fields.time',compact('Field','value'));
                break;
            case 'text':
                return view('ahmedmelhalaby.base.fields.text',compact('Field','value'));
                break;
            case 'number':
                return view('ahmedmelhalaby.base.fields.number',compact('Field','value'));
                break;
            case 'textarea':
                return view('ahmedmelhalaby.base.fields.textarea',compact('Field','value'));
                break;
            case 'image':
                return view('ahmedmelhalaby.base.fields.image',compact('Field','value'));
                break;
            case 'images':
                return view('ahmedmelhalaby.base.fields.images',compact('Field','value'));
                break;
            case 'date':
                return view('ahmedmelhalaby.base.fields.date',compact('Field','value'));
                break;
            case 'email':
                return view('ahmedmelhalaby.base.fields.email',compact('Field','value'));
                break;
            case 'select':
                return view('ahmedmelhalaby.base.fields.select',compact('Field','value'));
                break;
            case 'password':
                return view('ahmedmelhalaby.base.fields.password',compact('Field','value'));
                break;
            default :
                return $value;
                break;
        }
    }
    public static function Shows($Field,$value){
        switch ($Field['type']){
            case 'relation':
                return view('ahmedmelhalaby.base.shows.relation',compact('Field','value'));
                break;
            case 'datetime':
                return view('ahmedmelhalaby.base.shows.datetime',compact('Field','value'));
                break;
            case 'time':
                return view('ahmedmelhalaby.base.shows.time',compact('Field','value'));
                break;
            case 'text':
                return view('ahmedmelhalaby.base.shows.text',compact('Field','value'));
                break;
            case 'number':
                return view('ahmedmelhalaby.base.shows.number',compact('Field','value'));
                break;
            case 'textarea':
                return view('ahmedmelhalaby.base.shows.textarea',compact('Field','value'));
                break;
            case 'image':
                return view('ahmedmelhalaby.base.shows.image',compact('Field','value'));
                break;
            case 'images':
                return view('ahmedmelhalaby.base.shows.images',compact('Field','value'));
                break;
            case 'date':
                return view('ahmedmelhalaby.base.shows.date',compact('Field','value'));
                break;
            case 'email':
                return view('ahmedmelhalaby.base.shows.email',compact('Field','value'));
                break;
            case 'select':
                return view('ahmedmelhalaby.base.shows.select',compact('Field','value'));
                break;
            case 'password':
                return view('ahmedmelhalaby.base.shows.password',compact('Field','value'));
                break;
            default :
                return $value;
                break;
        }
    }
}
