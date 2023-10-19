<?php

namespace App\Http\Controllers\Administration;

use App;
use Mail;
use Config;
use Session;
use Validator;
use App\Libs\ACL;
use App\Libs\Adminauth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Administrator;
use App\Helpers\Functions;


class NotificationsController extends Administrator
{
    public $model;
    public $module;
    public $rules;
    public $hash;
    public $token;
    public $admin;

    public function __construct(Request $request, App\Models\AdminNotification $model)
    {
        // parent::__construct();
        $this->module = 'admin_notifications';
        $this->model = $model;
        $this->hash = trim($request->header("token"));
        $this->token = \App\Models\AdminToken::whereToken($this->hash)->first();
        // $this->admin = $this->token->admin;
        $this->rules = [
            'message' => 'required',
            'message_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',

        ];
    }

    public function getIndex(Request $request)
    {
        // authorize('view-' . $this->module);
        // $rows = App\Models\AdminNotification::latest()->paginate();

        $providers = \App\Models\Provider::where('country', session()->get('country')->id)->where('status','1')->get();
        $customers = \App\Models\Customer::where('country_id', session()->get('country')->id)->where('published','1')->get();
        return view('admin.Notifications.index',compact('customers','providers'));
    }


    public function postAllCustomer(Request $request)
    {
        // dd('all customers');

        $rules = [
            // 'customers_ids' => 'required|array|min:1',
            'message' => 'required',
            'message_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',

        ];

        $msgs = new \stdClass;

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $msgs = Lang::get($validator->errors()->first());
            session() -> flash('Error', $msgs);
            return redirect()->back();
        }
        $fields = [];
//        $ids = \App\Models\CustomerToken::whereNotNull("device_id")->get()->pluck("customer_id")->toArray();
        $ids = \App\Models\Customer::whereNotNull("country_id")->where('country_id',session()->get('country')->id)->get()->pluck("id")->toArray();
        // dd($ids);
        for ($i = 0; $i < sizeof($ids); $i++) {
            $device_ids = \App\Models\CustomerToken::where('customer_id', $ids[$i])->whereNotNull("device_id")->groupBy('mobile_id','device_id')->select("device_id")->get()->toArray();
//            $device_ids2 = array_unique($device_ids);
            //   dd($device_ids);
            try {


                 \App\Models\CustomerNotification::create(["customer_id" => $ids[$i], "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification", "message_ar" => $request->message_ar, "link" => $request->link]);
                // \App\Models\AdminNotification::create(["admin_id" => $this->admin->id, "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification to customer id " . $ids[$i], "message_ar" => $request->message_ar, "link" => $request->link]);


                $fields = array(
                    'registration_ids' => $device_ids,
                    'notification' => array(
                        "title" => $request->title,
                        "body" => $request->title,
                        "type" => 'notification from admin',
                        "sound" => "default.mp3"
                    ),
                    'data' => array(
                        "title" => $request->title_ar,
                        "body" => $request->title_ar,
                        "type" => 'اشعار من الادمن',
                        "sound" => "default.mp3",
                        "link" => $request->link
                    )
                );

                send_notification($fields);
                session() -> flash('Success', trans('Sent successfully'));

            } catch (\Exception $exception) {
                $msgs = Lang::get('Error in Sending Notification, try again later');
                session() -> flash('Error', $msgs);
                return redirect()->back();

            }


        }
        return redirect()->back();


    }


    public function postAllProvider(Request $request)
    {
// dd('all provider');
        $rules = [
            // 'ids' => 'required|array|min:1',
            'message' => 'required',
            'message_ar' => 'required',
            'type'=> 'required',

        ];

        $msgs = new \stdClass;

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $msgs = Lang::get($validator->errors()->first());
            session() -> flash('Error', $msgs);
        }
        $fields = [];
    //    $ids= $request->providers_ids;
        $ids = \App\Models\Provider::whereNotNull("country")->where('country',session()->get('country')->id)->get()->pluck("id")->toArray();

        //  dd($ids);
        for ($i = 0; $i < sizeof($ids); $i++) {
            $device_ids = \App\Models\ProviderToken::where('provider_id', $ids[$i])->whereNotNull("device_id")->groupBy('mobile_id','device_id')->select('device_id')->get()->toArray();
//            $device_ids2 = array_unique($device_ids);
            try {


                \App\Models\ProviderNotification::create(["provider_id" => $ids[$i], "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification", "message_ar" => $request->message_ar, "link" => $request->link]);
                // \App\Models\AdminNotification::create(["admin_id" => $this->admin->id, "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification to provider id " . $ids[$i], "message_ar" => $request->message_ar, "link" => $request->link]);


                $fields = array(
                    'registration_ids' => $device_ids,
                    'notification' => array(
                        "title" => $request->title,
                        "body" => $request->title,
                        "type" => 'notification from admin',
                        "sound" => "default.mp3"
                    ),
                    'data' => array(
                        "title" => $request->title_ar,
                        "body" => $request->title_ar,
                        "type" => 'اشعار من الادمن',
                        "sound" => "default.mp3",
                        "link" => $request->link
                    )
                );
                send_notification($fields);  // old

// new
                // $url = 'https://fcm.googleapis.com/fcm/send';
                // // $fields = array (
                // //         'registration_ids' => array (
                // //                 $id
                // //         ),
                // //         'notification' => array (
                // //                 "title" => $message,
                // //                 "body"=>"body"
                // //         )
                // // );
                // $fields = json_encode($fields);
                // $headers = array(
                //     'Authorization: key=' . "AAAAuzFVxTU:APA91bGNbcuiwMz7m-xk5rrcrhgxxCmszL6ODpqAZ0JA-fjhP5M--HCFZ-DpIyw31tRf-AF-lD7Fae5acPqns1YJD4JuUKhg_LVQfpIEy7NtHnUjfBuocTon_Z3IkAFi4qYR9bTmYzgo",
                //     'Content-Type: application/json'
                // );

                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, $url);
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                // $result = curl_exec($ch);
                // // dd($result);
                // curl_close($ch);
// end new

                session() -> flash('Success', trans('Sent successfully'));
            } catch (\Exception $exception) {
                $msgs = Lang::get('Error in Sending Notification, try again later');
                session() -> flash('Error', $msgs);

                return redirect()->back();
            }


        }
        return redirect()->back();


    }


    public function postCustomer(Request $request)
    {

        //  dd('select customer');
        $rules = [
            'customers_ids' => 'required|array|min:1',
            'message' => 'required',
            'message_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',

        ];

        $msgs = new \stdClass;

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            $msgs = Lang::get($validator->errors()->first());
            session() -> flash('Error', $msgs);
            return redirect()->back();
        }
        $fields = [];
        $ids = $request->customers_ids;
// dd($ids);
        for ($i = 0; $i < sizeof($ids); $i++) {
            $device_ids = \App\Models\CustomerToken::where('customer_id', $ids[$i])->whereNotNull("device_id")->groupBy('mobile_id','device_id')->select("device_id")->get()->toArray();
//            $device_ids2 = array_unique($device_ids);
            try {


                \App\Models\CustomerNotification::create(["customer_id" => $ids[$i], "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification", "message_ar" => $request->message_ar, "link" => $request->link]);
                // \App\Models\AdminNotification::create(["admin_id" => $this->admin->id, "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification to customer id " . $ids[$i], "message_ar" => $request->message_ar, "link" => $request->link]);


                $fields = array(
                    'registration_ids' => $device_ids,
                    'notification' => array(
                        "title" => $request->title,
                        "body" => $request->title,
                        "type" => 'notification from admin',
                        "sound" => "default.mp3"
                    ),
                    'data' => array(
                        "title" => $request->title_ar,
                        "body" => $request->title_ar,
                        "type" => 'اشعار من الادمن',
                        "sound" => "default.mp3",
                        "link" => $request->link
                    )
                );

                send_notification($fields);
                session() -> flash('Success', trans('Sent successfully'));
            } catch (\Exception $exception) {
                // dd($exception);
                $msgs = Lang::get('Error in Sending Notification, try again later');
                // dd($msgs);
                session() -> flash('Error', $msgs);
                return redirect()->back();

            }


        }
        return redirect()->back();


    }


    public function postProvider(Request $request)
    {
        $rules = [
            'providers_ids' => 'required|array|min:1',
            'message' => 'required',
            'message_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',

        ];
        $msgs = new \stdClass;

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            $msgs = Lang::get($validator->errors()->first());
            return response()->json(['isSuccessed' => false, "data" => null, 'error' => $msgs], 200);
        }
        $fields = [];
        $ids = $request->providers_ids;
        for ($i = 0; $i < sizeof($ids); $i++) {
            $device_ids = \App\Models\ProviderToken::where('provider_id', $ids[$i])->whereNotNull("device_id")->groupBy('mobile_id','device_id')->select("device_id")->get()->toArray();
//            $device_ids2 = array_unique($device_ids);
            try {


                \App\Models\ProviderNotification::create(["provider_id" => $ids[$i], "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification", "message_ar" => $request->message_ar, "link" => $request->link]);
                // \App\Models\AdminNotification::create(["admin_id" => $this->admin->id, "message" => $request->message, "relation_id" => null, "relation_object" => "Admin Notification to provider id " . $ids[$i], "message_ar" => $request->message_ar, "link" => $request->link]);


                $fields = array(
                    'registration_ids' => $device_ids,
                    'notification' => array(
                        "title" => $request->title,
                        "body" => $request->title,
                        "type" => 'notification from admin',
                        "sound" => "default.mp3"
                    ),
                    'data' => array(
                        "title" => $request->title_ar,
                        "body" => $request->title_ar,
                        "type" => 'اشعار من الادمن',
                        "sound" => "default.mp3",
                        "link" => $request->link
                    )
                );

                send_notification($fields);
                session() -> flash('Success', trans('Sent successfully'));
            } catch (\Exception $exception) {
                $msgs = Lang::get('Error in Sending Notification, try again later');
                session() -> flash('Error', $msgs);
                return redirect()->back();

            }


        }
        return redirect()->back();
    }
}
