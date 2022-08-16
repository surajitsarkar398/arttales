<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Repository\ApiRepository;
use App\Models\User;
use App\Models\Preference;
use App\Models\Contact;
use App\Http\Utility\DataService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Preference_subcategory;

class ApiService
{

	public function login($arg)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		/*  $pass = "123456";
			    $hp= hash::make($pass);
			    print_r($hp);
			    die;*/

		if (Auth::attempt(['email' => $arg['email'], 'password' => $arg['password']])) {
			$user = Auth::user();
			$arg['register_id'] 		= $user->register_id;
			$getUser  					= $ApiRepository->login($arg);
			if ($getUser) {
				$data->error_code = 200;
				$data->data = $getUser;
			}
		} else {
			$data->error_code = 430;
		}
		return $data;
	}


	public function register($arg)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->register($arg);
		if ($create_user) {
			$data->error_code = 636;
		} else {
			$data->error_code = 637;
		}
		return $data;
	}

	public function save_token($arg, $userId)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->save_token($arg, $userId);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 661;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}

		return $data;
	}

	public function delete_account($arg, $userId)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->delete_account($arg, $userId);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 674;
			$data->data = $update;
		} else if ($update['code'] == 674) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}

		return $data;
	}

	public function changePassword($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->changePassword($arg);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 204;
			$data->data = $update;
		} else if ($update['code'] == 675) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 681;
		}

		return $data;
	}

	public function privateAccount($arg, $userId)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->privateAccount($arg, $userId);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 678;
			$data->data = $update;
		} else if ($update['code'] == 678) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 679;
		}

		return $data;
	}
	public function PublicAccount($arg, $userId)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->PublicAccount($arg, $userId);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 680;
			$data->data = $update;
		} else if ($update['code'] == 680) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 681;
		}

		return $data;
	}









	public function profile($method, $arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();


		if ($method == 0) {

			$arg['register_id'] = Auth::user()->register_id;
			$update = $ApiRepository->updateprofile($arg);


			if ($update['code'] == 200) {

				unset($update['code']);
				$data->error_code = 217;
				$data->data = $update;
			} else if ($update['code'] == 410) {

				$data->error_code = $update['code'];
			} else {

				$data->error_code = 632;
			}
		}

		return $data;
	}




	public function fetchUser($arg)
	{
		//print_r($arg['register_id']);die;
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		if ($arg['register_id']) {

			$user = User::getUser($email = null, $arg['register_id']);
			$arg['register_id'] 		= $user->register_id;
			$getUser  					= $ApiRepository->fetchUser($arg);
			//print_r($getUser);die;	
			if ($getUser) {
				$data->error_code = 643;
				$data->data = $getUser;
			}
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function fetchfreindprofile($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$getUser = $ApiRepository->fetchfreindprofile($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}


	public function preferencelisting($arg)
	{

		$data 			= new DataService();
		$ApiRepository 	= new ApiRepository();
		$show_preferencelisting 	= $ApiRepository->preferencelisting($arg);
		if ($show_preferencelisting) {
			$data->error_code = 643;
		} else {
			$data->error_code = 425;
		}
		return $data;
	}

	public function preferenceSubcategory($arg)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$getUser = $ApiRepository->preferenceSubcategory($arg);
		if ($getUser) {
			$data->error_code = 650;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function preferenceUserListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->preferenceUserListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function sendAndAcceptRequest($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->sendAndAcceptRequest($arg);
		if ($create_user) {
			$data->error_code = 685;
		} else {
			$data->error_code = 686;
		}
		return $data;
	}

	public function following($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->following($arg);
		if ($create_user) {
			$data->error_code = 699;
		} else {
			$data->error_code = 686;
		}
		return $data;
	}



	public function requestListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->requestListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}



	public function follow($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->follow($arg);
		if ($create_user) {
			$data->error_code = 655;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function followingListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->followingListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function unfollow($arg)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->unfollowuser($arg);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 656;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}

		return $data;
	}

	public function block($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->block($arg);
		if ($create_user) {
			$data->error_code = 658;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function blockListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->blockListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function unblock($arg)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->unblockuser($arg);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 676;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}

		return $data;
	}

	public function tagListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		if ($arg['register_id']) {

			$user = User::getUser($email = null, $arg['register_id']);
			$arg['register_id'] 		= $user->register_id;
			$getUser  					= $ApiRepository->tagListing($arg);
			//print_r($getUser);die;	
			if ($getUser) {
				$data->error_code = 643;
				$data->data = $getUser;
			}
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function post($arg, $type)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->post($arg, $type);
		if ($create_user) {
			$data->error_code = 651;
		} else {
			$data->error_code = 652;
		}
		return $data;
	}
	// postvideo
	public function postvideo($arg, $type)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->postvideo($arg, $type);
		if ($create_user) {
			$data->error_code = 651;
		} else {
			$data->error_code = 652;
		}
		return $data;
	}

	public function post_like($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->post_like($arg);
		if ($create_user) {
			$data->error_code = 691;
		} else {
			$data->error_code = 637;
		}
		return $data;
	}

	public function post_unlike($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->post_unlike($arg);
		if ($create_user) {
			$data->error_code = 691;
		} else {
			$data->error_code = 637;
		}
		return $data;
	}


	public function favorite_post($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->favorite_post($arg);
		if ($create_user) {
			$data->error_code = 693;
		} else {
			$data->error_code = 694;
		}
		return $data;
	}

	public function dashboardListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$getUser = $ApiRepository->dashboardListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function contact($arg)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_contact = $ApiRepository->contact($arg);
		if ($create_contact) {
			$data->error_code = 677;
		} else {
			$data->error_code = 637;
		}
		return $data;
	}

	public function faqListing($arg)
	{

		$data 			= new DataService();
		$ApiRepository 	= new ApiRepository();
		$show_faqListing 	= $ApiRepository->faqListing($arg);
		if ($show_faqListing) {
			$data->error_code = 644;
		} else {
			$data->error_code = 425;
		}
		return $data;
	}
	public function updateProfile($arg, $userId)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();

		//print_r($arg);die;
		//$user = User::getUser($email=null,$arg['register_id']);

		$update = $ApiRepository->updateProfile($arg, $userId);

		//print_r($update);die;
		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 217;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}
		return $data;
	}
	public function updateProfileImage($arg, $userId)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->updateProfileImage($arg, $userId);

		//print_r($update);die;
		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 647;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 648;
		}
		//}



		return $data;
	}
	public function updateVisitingImage($arg, $userId)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->updateVisitingImage($arg, $userId);

		//print_r($update);die;
		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 653;
			$data->data = $update;
		} else if ($update['code'] == 410) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 654;
		}
		//}



		return $data;
	}

	public function registerStore($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->registerStore($arg);
		if ($create_user) {
			$data->error_code = 682;
		} else {
			$data->error_code = 683;
		}
		return $data;
	}

	public function savepost($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->savepost($arg);
		if ($create_user) {
			$data->error_code = 687;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function post_unsave($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->post_unsave($arg);
		if ($create_user) {
			$data->error_code = 697;
		} else {
			$data->error_code = 698;
		}
		return $data;
	}


	public function postComment($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->postComment($arg);
		if ($create_user) {
			$data->error_code = 684;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function mypost($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$getUser = $ApiRepository->mypost($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function commentListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->commentListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function comment_like($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->comment_like($arg);
		if ($create_user) {
			$data->error_code = 691;
		} else {
			$data->error_code = 637;
		}
		return $data;
	}
	public function comment_unlike($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->comment_unlike($arg);
		if ($create_user) {
			$data->error_code = 697;
		} else {
			$data->error_code = 698;
		}
		return $data;
	}



	public function savepostlisting($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->savepostlisting($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function review($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->review($arg);
		if ($create_user) {
			$data->error_code = 688;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function reviewlist($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->reviewlist($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}



	public function cart($arg)
	{

		$data = new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->cart($arg);
		if ($create_user) {
			$data->error_code = 689;
		} else {
			$data->error_code = 646;
		}
		return $data;
	}

	public function cartlist($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->cartlist($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function buy_now($arg)
	{

		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->buy_now($arg);
		if ($create_user) {
			$data->error_code = 703;
		} else {
			$data->error_code = 670;
		}
		return $data;
	}

	public function delete_cart($arg)
	{
		$data = new DataService();
		$ApiRepository = new ApiRepository();

		$update = $ApiRepository->delete_cart($arg);

		if ($update['code'] == 200) {

			unset($update['code']);
			$data->error_code = 690;
			$data->data = $update;
		} else if ($update['code'] == 690) {

			$data->error_code = $update['code'];
		} else {

			$data->error_code = 632;
		}

		return $data;
	}

	public function donotdisturb($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$getUser = $ApiRepository->donotdisturb($arg);
		if ($getUser) {
			$data->error_code = 696;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}

	public function notificationListing($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->notificationListing($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	public function artist_favorite($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->artist_favorite($arg);
		if ($create_user) {
			$data->error_code = 701;
		} else {
			$data->error_code = 702;
		}
		return $data;
	}
	public function artist_favorite_list($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->artist_favorite_list($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	public function sharepost($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$createshare = $ApiRepository->sharepost($arg);
		
		if ($createshare) {
			$data->error_code = 703;
			
			
		} else {
			$data->error_code = 704;
		}
		return $data;
	}

	public function inapropriatepost($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->inapropriatepost($arg);
		if ($create_user) {
			$data->error_code = 706;
		} else {
			$data->error_code = 707;
		}
		return $data;
	}
	public function edittag($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->edittag($arg);
		if ($create_user) {
			$data->error_code = 709;
		} else {
			$data->error_code = 710;
		}
		return $data;
	}
	public function visitnow($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->visitnow($arg);
		if ($create_user) {
			$data->error_code = 710;
		} else {
			$data->error_code = 711;
		}
		return $data;
	}
	public function track_order($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->track_order($arg);
		if ($create_user) {
			$data->error_code = 712;
			$data->data = $create_user;
		} else {
			$data->error_code = 713;
		}
		return $data;
	}

	public function delete_tag($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->delete_tag($arg);
		if ($create_user) {
			$data->error_code = 714;
			$data->data = $create_user;
		} else {
			$data->error_code = 715;
		}
		return $data;
	}

	public function return_order($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$create_user = $ApiRepository->return_order($arg);
		if ($create_user) {
			$data->error_code = 716;
			$data->data = $create_user;
		} else {
			$data->error_code = 715;
		}
		return $data;
	}
	public function current_order($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->current_order($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	public function past_order($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();

		$user = User::getUser($userId = null, $arg);
		$getUser = $ApiRepository->past_order($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	public function promotion($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		$getUser = $ApiRepository->promotion($arg);
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	public function report_user($arg)
	{
		$data = 	new DataService();
		$ApiRepository = new ApiRepository();
		
		$getUser = $ApiRepository->report_user($arg);
		
		if ($getUser) {
			$data->error_code = 643;
			$data->data = $getUser;
		} else {
			$data->error_code = 642;
		}
		return $data;
	}
	
}
