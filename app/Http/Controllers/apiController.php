<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Service\ApiService;
use App\Http\Controllers\Repository\ApiRepository;
use App\Models\Preference;
use App\Http\Controllers\Msg;
use App\Http\Utility\DataService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Utility\CustomVerfication;
use Dotenv\Validator as DotenvValidator;
use Facade\FlareClient\Report;

class apiController extends Controller
{

    // Register User Api

    public function register(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'     => 'required',
                'product_id' => 'required',
                'product_image' => 'required',
                'store_id'    => 'required',
                'store_category'    => 'max:225',
                'payment'           => 'max:255',
                'dates' => 'max:255',
                'times'      => 'required',
                'payment_method' => 'required',
                'status' => 'required',

                'user_id'=>'required',
                'shop_id'=>'required',
                'product_id'=>'required',
                'price'=>'required',
                'discount'=>'required',
                'tax'=>'required',
                'quantity'=>'required',
                'shipping_cost'=>'required',
                'shipping_address'=>'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->register($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 636) {

                    $response = ['code' => 1, 'status' => true, 'msg' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }
    //save_token 
    public function save_token(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token = $request->header('Authorization');
        if ($token != "") {
            $registerId = $this->Authorization($token);
            $Check = $ApiService->save_token($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 661) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "0", 'message' => "unauthenticate"];
        }
        return $response;
    }


    //Login User APi

    public function login(Request $request)
    {

        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {

            $rules = array('email' => 'required', 'password' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => 1, 'message' => $validation_error[0]];
            } else {

                $Check = $ApiService->login($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 200) {

                    $response = ['status' => 0, 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => 1, 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //logout user api
    public function logout(Request $request)
    {
        $error_msg = new Msg();
        $msg =  $error_msg->responseMsg(216);
        $response = ['status' => "1", 'message' =>  $msg];
        return $response;
    }

    //changePassword api
    public function changePassword(Request $request)
    {

        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $ApiRepository = new ApiRepository;
        if ($request->method() == 'POST') {

            $rules = array('mobile' => 'required', 'password' => 'required', 'repasswprd' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->changePassword($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 204) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }


    // delete Acount
    public function delete_account(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->delete_account($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 674) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "0", 'message' => "unauthenticate"];
        }

        return $response;
    }

    //privateAccount Api
    public function privateAccount(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->privateAccount($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 678) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "0", 'message' => "unauthenticate"];
        }

        return $response;
    }

    //PublicAccount
    public function PublicAccount(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->PublicAccount($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 680) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "0", 'message' => "unauthenticate"];
        }

        return $response;
    }



    //preference_maincategory_list

    public function preferenceListing(Request $request)
    {

        $ApiRepository = new ApiRepository;
        $preferenceList = $ApiRepository->getAllPefrence();
        $error_msg = new Msg();
        if (isset($preferenceList)) {

            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'preference_maincategory_list' => $preferenceList];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }

    // preference_subcategory_list
    public function preferenceSubcategory(Request $request)
    {

        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {

                $Check = $ApiService->preferenceSubcategory($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 650) {

                    $response = ['status' => "1", 'message' =>  $msg, 'preference_subcategory_list' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }
    //prference api

    public function prference(Request $request)
    {

        $ApiRepository = new ApiRepository;
        $preferenceListing = $ApiRepository->preferenceShow();
        //print_r($preferenceListing);die;
        $error_msg = new Msg();
        if (isset($preferenceListing)) {
            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $preferenceListing];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }

    //preferenceUserListing Api

    public function preferenceUserListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('sub_category_name' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->preferenceUserListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 643) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }

    // sendAndAcceptRequest Api
    public function sendAndAcceptRequest(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'  => 'required',
                'requested_id' => 'required'
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(686);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->sendAndAcceptRequest($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 685) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }
    //following
    public function following(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'  => 'required',
                'requested_id' => 'required'
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(686);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->following($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 699) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }
    //fetchfreindprofile
    public function fetchfreindprofile(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {

            $rules = array('register_id' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => 1, 'message' => $validation_error[0]];
            } else {

                $Check = $ApiService->fetchfreindprofile($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 643) {

                    $response = ['status' => 1, 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => 0, 'message' =>  $msg];
                }
            }

            return $response;
        }
    }


    //requestListing APi

    public function requestListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->requestListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 643) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }


    // follow Api
    public function follow(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'  => 'required',
                'requested_id' => 'required|unique:connections'
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(657);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->follow($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 655) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    // followingListing Api

    public function followingListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->followingListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 643) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }


    // Un_follow Api
    public function unfollow(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {
            $rules = array(
                'connection_id' => 'required',
                'register_id' => 'required',
                'requested_id' => 'required',

            );
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(657);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->unfollow($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 656) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }
    //block api
    public function block(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'  => 'required',
                'requested_id' => 'required'
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(657);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->block($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 658) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //blockListing APi

    public function blockListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->blockListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 643) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }

    //unblock api
    public function unblock(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {
            $rules = array(
                'connection_id' => 'required',
                'register_id' => 'required',
                'requested_id' => 'required',

            );
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(657);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->unblock($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 659) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //tagListing api
    public function tagListing(Request $request)
    {

        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {

            $rules = array('register_id' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {

                //if($request->vConnection == 'Following'){
                //$vConnection = 'Following';
                //$Check = $ApiService->tagListing($data,$vConnection);
                $Check = $ApiService->tagListing($data);

                //}
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 643) {

                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //postModule api
    public function postModule(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        $rules = array(
            'post_image'  => 'required',
            'descriptions' => '',
            'type'        => '',
            'register_id' => '',
        );
        if ($request->type == 'product') {
            $rules = array(
                'post_image'         => 'required',
                'descriptions'       => 'required',
                'type'               => 'required',
                'register_id'        => 'required',
                'product_name'       => 'required',
                'price'              => 'required',
                'discount'           => 'required',
                'offer_price'        => 'required',
                'product_image'      => 'required',
                'product_description' => 'required',

            );
        }
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            if ($request->type == 'product') {
                $type = 1;
                $Check = $ApiService->post($data, $type);
            } else {
                $type = 0;
                $Check = $ApiService->post($data, $type);
            }
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 651) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    //postModule api
    public function postvideo(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        $rules = array(
            'post_image'  => 'required',
            'descriptions' => 'required',
            'type'        => 'required',
            'register_id' => 'required',
        );
        if ($request->type == 'product') {
            $rules = array(
                'post_image'         => 'required',
                'descriptions'       => 'required',
                'type'               => 'required',
                'register_id'        => 'required',
                'product_name'       => 'required',
                'price'              => 'required',
                'discount'           => 'required',
                'offer_price'        => 'required',
                'product_image'      => 'required',
                'product_description' => 'required',

            );
        }
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            if ($request->type == 'product') {
                $type = 1;
                $Check = $ApiService->postvideo($data, $type);
            } else {
                $type = 0;
                $Check = $ApiService->postvideo($data, $type);
            }
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 651) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }


    //post_like Api
    public function post_like(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'post_id'        => 'required',
                'register_id' => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->post_like($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 691) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }

    //post_unlike Api
    public function post_unlike(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'id'        => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->post_unlike($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 691) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //favorite_post
    public function favorite_post(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'post_id'        => 'required',
                'register_id' => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->favorite_post($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 693) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //favorite_post_listing Api
    public function favorite_post_listing(Request $request)
    {

        $ApiRepository = new ApiRepository;
        $searchUserList = $ApiRepository->favorite_post_listing();
        $error_msg = new Msg();
        if (isset($searchUserList)) {
            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $searchUserList];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }
    //poetListing
    public function poetListing(Request $request)
    {

        $ApiRepository = new ApiRepository;
        $poetListing = $ApiRepository->getAllPoet();
        $error_msg = new Msg();
        if (isset($poetListing)) {

            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $poetListing];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }
    //mypost
    public function mypost(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if($request->method() == 'POST'){
            $rules = array('register_id' => 'required');
            $validation = Validator :: make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => 1, 'message' => $validation_error[0]];
            } else {

                $Check = $ApiService->mypost($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 643) {

                    $response = ['status' => 1, 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => 0, 'message' =>  $msg];
                }
            }
            return $response;
        }
    }

    //dashboardListing api

    public function dashboardListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {

            $rules = array('register_id' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => 1, 'message' => $validation_error[0]];
            } else {

                $Check = $ApiService->dashboardListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 643) {

                    $response = ['status' => 1, 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => 0, 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //searchUserListing Api
    public function searchUserListing(Request $request)
    {
        $ApiRepository = new ApiRepository;
        $searchUserList = $ApiRepository->searchUserListing();
        $error_msg = new Msg();
        if (isset($searchUserList)) {
            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $searchUserList];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }



    //fatch user details
    public function fetchUser(Request $request)
    {

        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {

            $rules = array('register_id' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'msg' => $validation_error[0]];
            } else {

                $Check = $ApiService->fetchUser($data);
                $msg =  $error_msg->responseMsg($Check->error_code);

                if ($Check->error_code == 643) {

                    $response = ['code' => 200, 'msg' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['code' => $Check->error_code, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }

    //updateProfile Api

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->updateProfile($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 217) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                    'data'  =>  $Check->data
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "0", 'message' => "unauthenticate"];
        }

        return $response;
    }


    //updateProfileImage Api

    public function updateProfileImage(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->updateProfileImage($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 647) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,

                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "1", 'message' => "unauthenticate"];
        }

        return $response;
    }
    //updateVisitingImage APi

    public function updateVisitingImage(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        $token  =  $request->header('Authorization');
        if ($token != "") {
            $registerId  = $this->Authorization($token);
            $Check = $ApiService->updateVisitingImage($data, $registerId);
            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 653) {
                $response = [
                    'status'  =>  "1",
                    'message'   =>  $msg,
                    // 'data'  =>  $Check->data  
                ];
            } else {
                $response = [
                    'status' => "0",
                    'message' =>  $msg
                ];
            }
        } else {

            $response = ['status' => "1", 'message' => "unauthenticate"];
        }

        return $response;
    }

    //contactus Api
    public function contactus(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
            );
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->contact($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 645) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //faqListing Api
    public function faqListing(Request $request)
    {

        $ApiRepository = new ApiRepository;
        $faqListing = $ApiRepository->getAllFaq();
        $error_msg = new Msg();
        if (isset($faqListing)) {

            $msg =  $error_msg->responseMsg(644);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $faqListing];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }


    // public function preferenceListing(Request $request){

    //     $ApiRepository = new ApiRepository;
    //     $preferenceList = $ApiRepository->getAllPefrence();
    //     $error_msg = new Msg();
    //     if(isset($preferenceList)){

    //         $msg =  $error_msg->responseMsg(643);
    //         $response = ['code' => 200, 'msg'=>  $msg, 'data' => $preferenceList];

    //     }
    //     else{
    //         $msg =  $error_msg->responseMsg(425);
    //         $response = ['code' => 425,'msg'=>  $msg ];
    //     }
    //     return $response;
    // }   

    public function profile(Request $request)
    {


        if ($request->method() == 'POST') {

            $data = $request->all();

            $Is_method = 0;
            $ApiService = new ApiService();
            $Check = $ApiService->profile($Is_method, $data);

            $error_msg = new Msg();
            $msg =  $error_msg->responseMsg($Check->error_code);

            if ($Check->error_code == 217) {
                $response = [
                    'code'  =>  200,
                    'msg'   =>  $msg,
                    'data'  =>  $Check->data
                ];
            } else {
                $response = [
                    'code' => $Check->error_code,
                    'msg' =>  $msg
                ];
            }
        }
        return $response;
    }


    //registerStore Api

    public function registerStore(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'store_name' => 'required|max:255',
                'store_image' => 'required',
                'category' => 'required|max:255',
                'mobile' => 'required',
                'email' => 'required',
                'website' => 'required',
                'address' => 'required',
                'attachment' => 'required',
                'register_id' => 'required'
            );
        }
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg = $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->registerStore($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 636) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }

        return $response;
    }

    //storlisting Api
    public function storlisting(Request $request)
    {
        $ApiRepository = new ApiRepository;
        $storlisting = $ApiRepository->storlisting();
        $error_msg = new Msg();
        if (isset($storlisting)) {
            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $storlisting];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }

    //postComment Api
    public function postComment(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id' => 'required',
                'request_id' => '',
                'comment' => 'required|max:255',
                'post_id' => '',
                'product_id' => '',
                'tag' => '',
            );
        }
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg = $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->postComment($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 684) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }


    //commentListing APi
    public function commentListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        //print_r($data);die;
        if ($request->method() == 'POST') {
            $rules = array('post_id' => '', 'product_id' => '', 'register_id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->commentListing($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 643) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }

    //comment_like Api
    public function comment_like(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'comment_id'  => 'required',
                'register_id' => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->comment_like($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 691) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }
    ///
    public function comment_unlike(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'id'        => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->comment_unlike($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 697) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //savepost Api
    public function savepost(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id' => 'required',
                'post_id' => 'required',
            );
        }
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg = $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->savepost($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 687) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    public function post_unsave(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'id'        => 'required',
                'register_id' =>'required',
                'post_id' =>'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->post_unsave($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 697) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //savepostlisting
    public function savepostlisting(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->savepostlisting($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 696) {
                    $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }
            return $response;
        }
    }

    //review Api 

    public function review(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id' => 'required',
                'product_id' => 'required',
                'review' => 'required',
            );
        }
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg = $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->review($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 688) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    //reviewlist Api 

    public function reviewlist(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('product_id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->reviewlist($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    //cart Api

    public function cart(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id' => 'required',
                'store_id' => 'required',
                'product_id' => 'required',
                'price' => 'required',
                'discount' => '',
                'quantity' => 'required',
            );
        }
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg = $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->cart($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 689) {

                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }


    //cartlist Api
    public function cartlist(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->cartlist($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    //delete_cart Api

    public function delete_cart(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->delete_cart($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 690) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    public function buy_now(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id'     => 'required',
                'product_id' => 'required',
                'product_image' => 'required',
                'store_id'    => 'required',
                'store_category'    => 'max:225',
                'payment'           => 'max:255',
                'dates' => 'max:255',
                'times'      => 'required',
                'payment_method' => 'required',
               
               
             );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => "0", 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->buy_now($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 703) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
    }

    //Do not Disturb Api
    public function donotdisturb(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {

            $rules = array('register_id' => 'required');

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['status' => 1, 'message' => $validation_error[0]];
            } else {
                $Check = $ApiService->donotdisturb($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 696) {
                    $response = ['status' => 1, 'message' =>  $msg];
                } else {
                    $response = ['status' => 0, 'message' =>  $msg];
                }
            }

            return $response;
        }
    }
    //notificationListing Api 
    public function notificationListing(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->notificationListing($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }

    //artist_favorite api
    public function artist_favorite(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'register_id' => 'required',
                'requested_id'=> 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->artist_favorite($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 701) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['status' => "0", 'message' =>  $msg];
                }
            }

            return $response;
        }
        
    }
    //artist_favorite_list
    public function artist_favorite_list(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') 
        {
            $rules = array(
                'register_id' => 'required',
            );
            
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->artist_favorite_list($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;

    }
    //share_post
    public function sharepost(Request $request)
    {
        
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') 
        {
            $rules = array(
                'post_id' => 'required',
                'share_with' => 'required',
                'share_by' => 'required',
            );
            
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->sharepost($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 703) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;

    }

     //share_post_listing
     public function sharepostlisting(Request $request)
    {
        $ApiRepository = new ApiRepository;
        $sharepostlisting = $ApiRepository->sharepostlisting();
        $error_msg = new Msg();
       
        if ($sharepostlisting) {
            $msg =  $error_msg->responseMsg(705);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $sharepostlisting];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }
    //post_inapropriate
    public function inapropriatepost(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'post_id'        => 'required',
                'register_id' => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {

                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->inapropriatepost($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 706) {

                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }
    public function search_artist(Request $request)
    {
        $data = $request->all();
        $ApiRepository = new ApiRepository;
        $sharepostlisting = $ApiRepository->search_artist($data);
        $error_msg = new Msg();
        
        if ($sharepostlisting) {
            $msg =  $error_msg->responseMsg(708);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $sharepostlisting];
        } else {
            $msg =  $error_msg->responseMsg(709);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }
    public function edittag(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'post_id' => 'required',
                'tag' => 'required',
            );

            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->edittag($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 709) {
                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        }
    }
    public function visitnow(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'user_id' => 'required',
                'post_id' => 'required',
            );
            
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->visitnow($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 710) {
                    $response = ['status' => "1", 'message' =>  $msg];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        } 
    }
    public function track_order(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();

        if ($request->method() == 'POST') {

            $rules = array(
                'order_id' => 'required',
             );
            
            $validation = Validator::make($data, $rules);

            if ($validation->fails()) {
                $validation_error = $validation->errors()->all();
                $msg =  $error_msg->responseMsg(403);
                $response = ['code' => 403, 'status' => false, 'msg' => $validation_error[0]];
            } else {
                $Check = $ApiService->track_order($data);
                $msg =  $error_msg->responseMsg($Check->error_code);
                if ($Check->error_code == 712) {
                    $response = ['status' => "1", 'message' =>  $msg,'data' =>  $Check,];
                } else {
                    $response = ['code' => $Check->error_code, 'status' => false, 'msg' =>  $msg];
                }
            }

            return $response;
        } 
    }
    public function search_tag(Request $request)
    {
        $ApiRepository = new ApiRepository;
        $searchUserList = $ApiRepository->search_tag();
        $error_msg = new Msg();
        if (isset($searchUserList)) {
            $msg =  $error_msg->responseMsg(643);
            $response = ['status' => "1", 'message' =>  $msg, 'data' => $searchUserList];
        } else {
            $msg =  $error_msg->responseMsg(425);
            $response = ['status' => "0", 'message' =>  $msg];
        }
        return $response;
    }

        //Delete tag//
    public function delete_tag(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array(
                'post_id' => 'required',
                'tag' => 'required',
             );
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->delete_tag($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 690) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }
    public function return_order(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array(
                'order_id' => 'required',
                'register_id' => 'required',
             );
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->return_order($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 716) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }
    public function current_order(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->current_order($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }
    public function past_order(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array('register_id' => 'required');
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->past_order($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 643) {
                $response = ['status' => "1", 'message' =>  $msg, 'data' => $Check->data];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }
    public function promotion(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array(
                'post_id' => 'required',
                'budget_daily' => 'required',
                'duration_days' => 'required',
                'estimated_reach' => 'required',
                'total_spend' => 'required',
                'tax' => 'required',
             );
            $validation = Validator::make($data, $rules);
        }
        if ($validation->fails()) {
            $validation_error = $validation->errors()->all();
            $msg =  $error_msg->responseMsg(403);
            $response = ['status' => "0", 'message' => $validation_error[0]];
        } else {
            $Check = $ApiService->promotion($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 716) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        }
        return $response;
    }
    public function report_user(Request $request)
    {
        $data = $request->all();
        $error_msg = new Msg();
        $ApiService = new ApiService();
        if ($request->method() == 'POST') {
            $rules = array(
                'register_id' => 'register_id',
                'report_by' => 'report_by',
                'description' => 'description',
              );
          
          
        }
      
    
           
            $Check = $ApiService->report_user($data);
            $msg =  $error_msg->responseMsg($Check->error_code);
            if ($Check->error_code == 716) {
                $response = ['status' => "1", 'message' =>  $msg];
            } else {
                $response = ['status' => "0", 'message' =>  $msg];
            }
        
        return $response;
    }
    
    
    
}
