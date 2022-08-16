<?php

namespace App\Http\Controllers\Repository;

// use App\Models\User;
// use App\Models\token;
// use App\Models\Preference;
// use App\Models\Contact;
// use App\Models\Photo;
// use App\Http\Utility\CustomVerfication;
// use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Utility\SendEmails;
// use Illuminate\Support\Facades\URL;
// use App\Models\Preference_subcategory;
// use App\Http\Utility\DataService;
// use App\Models\Connection;
// use Auth;

use App\Models\User;
use App\Models\token;
use App\Models\Preference;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\Poet;
use App\Models\Preference_subcategory;
use App\Models\Short_story;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Connection;
use App\Http\Utility\DataService;
use App\Http\Utility\CustomVerfication;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Utility\SendEmails;
use Illuminate\Support\Facades\URL;
use Auth;
use App\Models\Store;
use App\Models\Comment;
use App\Models\Savepost;
use App\Models\Review;
use App\Models\cart;
use App\Models\comment_like;
use App\Models\favorite_post;
use App\Models\post_like;
use App\Models\send_notifications;


class ApiRepository extends User
{
  private $access_token;
  private $token_id;
  public function __construct()
  {
    // access  token
    $this->token_id = mt_rand();
    $this->access_token = sha1(md5("ARTTALES" . $this->token_id . "!@#$%^&*!!"));
  }

  public function login($data)
  {

    if (isset($data['register_id'])) {
      $getUsers = User::getUser($email = null, $data['register_id']);
      $acesstoken = $this->access_token;

      $token = new token;
      $token->register_id = $data['register_id'];
      $token->token = $acesstoken;
      $token->save();
    }



    if (isset($getUsers)) {
      $userdata['register_id']  =   $getUsers->register_id;
      $userdata['name']          =   $getUsers->name ?   $getUsers->name : '';
      $userdata['country_code'] =   $getUsers->country_code ?   $getUsers->country_code : '';
      $userdata['mobile']        =   $getUsers->mobile ?   $getUsers->mobile : '';
      $userdata['dob']           =    $getUsers->dob ? $getUsers->dob : '';
      $userdata['email']         =   $getUsers->email   ?   $getUsers->email : '';
      $userdata['image']         =   $getUsers->image   ?   $getUsers->image : '';
      $userdata['description']           =   $getUsers->description   ?  $getUsers->description : '';
      $userdata['website']       =    $getUsers->website ? $getUsers->website : '';
      $userdata['major_achivement'] =    $getUsers->major_achivement ? $getUsers->major_achivement : '';
      $userdata['genres']       =    $getUsers->genres ? $getUsers->genres : '';
      $userdata['work_at']       =    $getUsers->work_at ? $getUsers->work_at : '';
      $userdata['performance']   =    $getUsers->performance ? $getUsers->performance : '';
      $userdata['visiting_card'] =   $getUsers->visiting_card   ?   $getUsers->visiting_card : '';
      $userdata['access_token'] =   $acesstoken;
      $userdata['role']         =   $getUsers->role   ?   $getUsers->role : '';
    } else {

      $userdata['code'] = 461;
    }

    return $userdata;
  }


  public function register($data)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";
    $image = $data['image'] ?? null;
    if ($image != null) {
      $image = $CustomVerfication->imageUpload($image, $path);
    } else {
      $image = null;
    }

    $visting = $data['visiting_card'] ?? null;
    if ($visting != null) {
      $visiting_card = $CustomVerfication->imageUpload($visting, $path);
    } else {
      $visiting_card = null;
    }


    $user = new User;

    $user->name                = $data['name'];
    $user->country_code        = $data['country_code'];
    $user->mobile              = $data['mobile'];
    $user->dob                 = $data['dob'];
    $user->email               = $data['email'];
    $user->password            = hash::make($data['password']);
    $user->repasswprd          = hash::make($data['repasswprd']);
    $user->image               = $image;
    $user->description                 = $data['description'];
    $user->website             = $data['website'];
    $user->major_achivement        = $data['major_achivement'];
    $user->genres              = $data['genres'];
    $user->work_at             = $data['work_at'];
    $user->performance         = $data['performance'];
    $user->visiting_card       = $visiting_card;
    $user->role                = $data['role'];

    $user->save();

    return $user;
  }

  public function save_token($data, $userId)
  {

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->device_token =  @$data['device_token'] ? @$data['device_token'] : '';

    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;

    return $userdata;
  }

  public function delete_account($data, $userId)
  {

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->is_deleted =  1;
    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;

    return $userdata;
  }

  public function changePassword($data)
  {
    if (isset($_POST['mobile']) && isset($_POST['password'])  && isset($_POST['repasswprd'])) {
      $mobile = $_POST["mobile"];
      $password   = $_POST['password'];
      $repasswprd   = $_POST['repasswprd'];
      $user = User::where('mobile', '=', $mobile)->first();
      // dd($user);
      if ($password === $repasswprd) {
        $user->password = hash::make($data['password']);
        $user->repasswprd = hash::make($data['repasswprd']);
        $user->save();
        $userdata['code'] = 200;
      } else {
        $userdata['code'] = 675;
      }
      return $userdata;
    }
  }

  public function Checkuser($data)
  {

    if (isset($data['email']) && isset($data['code'])) {
      $getUsers = User::where('email', $data['email'])
        ->where('forgot_password_code', $data['code'])->first();
    } else if (isset($data['id'])) {

      $getUsers = User::findorfail($data['id']);
    }

    return $getUsers;
  }

  // public function updateprofile($data)
  // {

  //   $getUsers   = User::find($data['register_id']);
  //   $query  = 0;
  //   if (isset($data['email'])) {
  //     $query = User::where('email', @$data['email'])->where('register_id', '!=', @$data['register_id'])->count();
  //   }
  //   if ($query == 0) {
  //     $getUsers->register_id            =  @$data['register_id'] ? @$data['register_id'] : $getUsers->register_id;
  //     $getUsers->name                   =  @$data['name'] ? @$data['name'] : $getUsers->name;
  //     $getUsers->country_code           =  @$data['country_code'] ? @$data['country_code'] : $getUsers->country_code;
  //     $getUsers->mobile                 =  @$data['mobile'] ? @$data['mobile'] : $getUsers->mobile;
  //     $getUsers->dob                    =  @$data['dob'] ? @$data['dob'] : $getUsers->dob;
  //     $getUsers->email                  =  @$data['email'] ? @$data['email'] : $getUsers->email;
  //     $getUsers->image                  =  @$data['image'] ? @$data['image'] : $getUsers->image;
  //     $getUsers->bio                    =  @$data['bio']  ? @$data['bio'] : $getUsers->bio;
  //     $getUsers->website                =  @$data['website'] ? @$data['website'] : $getUsers->website;
  //     $getUsers->major_achive           =  @$data['major_achive'] ? @$data['major_achive'] : $getUsers->major_achive;
  //     $getUsers->genres                 =  @$data['genres'] ? @$data['genres'] : $getUsers->genres;
  //     $getUsers->work_at                =  @$data['work_at'] ? @$data['work_at'] : $getUsers->work_at;
  //     $getUsers->performance            =  @$data['performance'] ? @$data['performance'] : $getUsers->performance;
  //     $getUsers->visiting_card          =  @$data['visiting_card'] ? @$data['visiting_card'] : $getUsers->visiting_card;

  //     $getUsers->save();


  //     $userdata['register_id']           =   $getUsers->register_id;
  //     $userdata['name']                  =   $getUsers->name ?   $getUsers->name : '';
  //     $userdata['country_code']          =   $getUsers->country_code  ?   $getUsers->country_code : '';
  //     $userdata['mobile']                =   $getUsers->mobile   ?   $getUsers->mobile : '';
  //     $userdata['dob']                   =   $getUsers->dob  ? $getUsers->dob : '';
  //     $userdata['email']                 =   $getUsers->email  ?   $getUsers->email : '';
  //     $userdata['image']                 =   $getUsers->image ? $getUsers->image : '';
  //     $userdata['bio']                   =   $getUsers->bio ? $getUsers->bio : '';
  //     $userdata['description']           =   $getUsers->description ? $getUsers->description : '';
  //     $userdata['website']               =   $getUsers->website ? $getUsers->website : '';
  //     $userdata['major_achive']          =   $getUsers->major_achive ? $getUsers->major_achive : '';
  //     $userdata['genres']                =   $getUsers->genres ? $getUsers->genres : '';
  //     $userdata['work_at']               =   $getUsers->work_at  ? $getUsers->work_at : '';
  //     $userdata['performance']           =   $getUsers->performance ? $getUsers->performance : '';
  //     $userdata['visiting_card']         =   $getUsers->visiting_card ? $getUsers->visiting_card : '';
  //     $userdata['role']                  =   $getUsers->role   ?   $getUsers->role : '';
  //     $userdata['code'] = 200;
  //   } else {

  //     $userdata['code'] = 410;
  //   }

  //   return $userdata;
  // }

  public function updateProfile($data, $userId)
  {

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->name                   =  @$data['name']          ? @$data['name']         : '';
    $getUsers->mobile                 =  @$data['mobile']        ? @$data['mobile']       : '';
    $getUsers->dob                    =  @$data['dob']           ? @$data['dob']          : '';
    $getUsers->email                  =  @$data['email']         ? @$data['email']        : '';
    $getUsers->description                    =  @$data['description']           ? @$data['description']          : '';
    $getUsers->website                =  @$data['website']       ? @$data['website']      : '';
    $getUsers->major_achivement           =  @$data['major_achivement']  ? @$data['major_achivement'] : '';
    $getUsers->genres                 =  @$data['genres']        ? @$data['genres']       : '';
    $getUsers->work_at                =  @$data['work_at']       ? @$data['work_at']      : '';
    $getUsers->performance            =  @$data['performance']   ? @$data['performance']  : '';

    $getUsers->save();
    // print_r($getUsers);die;

    $userdata['register_id']           =   $getUsers->register_id;
    $userdata['name']                  =   $getUsers->name ?   $getUsers->name : '';
    $userdata['mobile']                =   $getUsers->mobile   ?   $getUsers->mobile : '';
    $userdata['dob']                   =   $getUsers->dob  ? $getUsers->dob : '';
    $userdata['email']                 =   $getUsers->email  ?   $getUsers->email : '';
    $userdata['image']                 =   'https://ap-group.us/arttales/public/images/register/' . $getUsers->image ? 'https://ap-group.us/arttales/public/images/register/' . $getUsers->image : '';
    $userdata['description']           =   $getUsers->description ? $getUsers->description : '';
    $userdata['website']               =   $getUsers->website ? $getUsers->website : '';
    $userdata['major_achivement']          =   $getUsers->major_achivement ? $getUsers->major_achivement : '';
    $userdata['genres']                =   $getUsers->genres ? $getUsers->genres : '';
    $userdata['work_at']               =   $getUsers->work_at  ? $getUsers->work_at : '';
    $userdata['performance']           =   $getUsers->performance ? $getUsers->performance : '';
    $userdata['visiting_card']         =   'https://ap-group.us/arttales/public/images/register/' . $getUsers->visiting_card ? 'https://ap-group.us/arttales/public/images/register/' . $getUsers->visiting_card : '';

    $userdata['code'] = 200;



    return $userdata;
  }
  public function updateProfileImage($data, $userId)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";
    $image = @$data['image'] ?? null;
    if ($image != null) {
      $image = $CustomVerfication->imageUpload($image, $path);
    } else {
      $image = null;
    }

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->image                  =  $image;

    $getUsers->save();
    $userdata['image'] =   'https://ap-group.us/arttales/public/images/register/' . $getUsers->image ? 'https://ap-group.us/arttales/public/images/register/' . $getUsers->image : '';

    $userdata['code'] = 200;



    return $userdata;
  }
  public function updateVisitingImage($data, $userId)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";

    $visting = @$data['visiting_card'] ?? null;
    if ($visting != null) {
      $visiting_card = $CustomVerfication->imageUpload($visting, $path);
    } else {
      $visiting_card = null;
    }
    $getUsers = User::where("register_id", $userId)->first();

    $getUsers->visiting_card          =  $visiting_card;

    $getUsers->save();
    $userdata['visiting_card']         =   'https://ap-group.us/arttales/public/images/register/' . $getUsers->visiting_card ? 'https://ap-group.us/arttales/public/images/register/' . $getUsers->visiting_card : '';

    $userdata['code'] = 200;



    return $userdata;
  }



  public function change_password($data)
  {

    $getUsers   = User::find($data['id']);
    $Checkuser = Auth::attempt(array('email' => $getUsers->email, 'password' => $data['old_password']));
    //$Checkuser = Auth::check($data['old_password'], $getUsers->password);
    if ($Checkuser) {

      $getUsers   = User::find($data['id']);
      $getUsers->password = bcrypt($data['new_password']);
      $getUsers->save();
      $userdata['code'] = 204;
    } else {

      $userdata['code'] = 640;
    }

    return $userdata;
  }

  public function privateAccount($data, $userId)
  {

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->account_type =  1;
    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;

    return $userdata;
  }

  public function PublicAccount($data, $userId)
  {

    $getUsers = User::where("register_id", $userId)->first();
    $getUsers->account_type =  0;
    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;

    return $userdata;
  }



  public function preferenceSubcategory($data)
  {

    if (isset($data)) {
      $getDetails = Preference_subcategory::where('id', $data)->get();
    }

    $array1 = array();
    $array2 = array();

    foreach ($getDetails as $list) {

      $array1['preference_subcategories_name'] = @$list->preference_subcategories_name ? $list->preference_subcategories_name : '';
      $array1['preference_subcategories_id']   =    @$list->preference_subcategories_id ? $list->preference_subcategories_id : '';


      array_push($array2, $array1);
    }
    return $array2;
  }

  public function preferenceShow()
  {
    $data =   new DataService();
    $preferenceList = Preference::orderBy('preferences_name', 'asc')->get();
    //orderBy('id', 'asc')->
    $preference = array();
    $data->preferenceData = array();
    $PhotoData = array();
    $PhotoArr = array();
    foreach ($preferenceList as $list) {

      $preference['preference_id']     =  @$list->id ? $list->id : '';
      $preference['preference_name']   =  @$list->preferences_name ? $list->preferences_name : '';

      $preferenceSubList = Preference_subcategory::where('id', '=', $list->id)->orderBy('preference_subcategories_name', 'asc')->get();

      foreach ($preferenceSubList as $sublist) {
        $PhotoData['preference_subcategories_id']     =  @$sublist->preference_subcategories_id ? $sublist->preference_subcategories_id : '';
        $PhotoData['preference_subcategories_name']   =  @$sublist->preference_subcategories_name ? $sublist->preference_subcategories_name : '';

        array_push($PhotoArr, $PhotoData);
      }
      $preference['preference_subcategories'] = $PhotoArr;
      $PhotoArr = [];
      array_push($data->preferenceData, $preference);
    }

    return $data->preferenceData;
  }


  public function preferenceUserListing($data)
  {

    if (isset($data)) {
      $getDetails = User::where('sub_category_name', $data)->get();
    }
    $array1 = array();
    $array2 = array();
    foreach ($getDetails as $list) {
      $array1['sub_category_name'] = @$list->sub_category_name ? $list->sub_category_name : '';
      $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$list->image ? 'https://ap-group.us/arttales/public/images/register/' . $list->image : '';
      $array1['name']   =    @$list->name ? $list->name : '';
      $array1['major_achive']   =    @$list->major_achive ? $list->major_achive : '';
      $array1['register_id'] = @$list->register_id ? $list->register_id : '';
      array_push($array2, $array1);
    }
    return $array2;
  }
  // sendAndAcceptRequest
  public function sendAndAcceptRequest($data)
  {
    $user = new Connection;
    $user->register_id       = $data['register_id'];
    $user->requested_id      = $data['requested_id'];
    $user->vConnection       = "Request";
    $user->save();

    $notification = new send_notifications;
    $notification->register_id             = $data['register_id'];
    $notification->requested_id         = $data['requested_id'];

    $notification->notification_to         = $data['requested_id'];
    $notification->notification_type       = "Send Request";
    $notification->notification_time       = date('Y-m-d H:i:s');
    $notification->notification_text       = 'Send Request';
    $notification->save();

    return $user;
  }

  public function requestListing($data)
  {
    if (isset($data)) {
      $getDetails = Connection::where('register_id', $data)->get();
    }
    $array1 = array();
    $array2 = array();
    foreach ($getDetails as $list) {
      $array1['requested_id'] = @$list->requested_id ? $list->requested_id : '';
      $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$list->image ? 'https://ap-group.us/arttales/public/images/register/' . $list->image : '';
      $array1['name']   =    @$list->name ? $list->name : '';
      $array1['major_achive']   =    @$list->major_achive ? $list->major_achive : '';
      $array1['register_id'] = @$list->register_id ? $list->register_id : '';
      array_push($array2, $array1);
    }
    return $array2;
  }

  public function follow($data)
  {
    $user = new Connection;
    $user->register_id       = $data['register_id'];
    $user->requested_id      = $data['requested_id'];
    $user->vConnection       = "Following";
    $user->save();
    return $user;
  }

  public function followingListing($data)
  {

    $getDetails = Connection::where('register_id', $data)
      ->where('connections.vConnection', 'Following')->get();
    $array1 = array();
    $array2 = array();
    foreach ($getDetails as $list) {
      $array1['register_id'] = @$list->register_id ? $list->register_id : '';
      $array1['requested_id'] = @$list->requested_id ? $list->requested_id : '';
      $getUser = User::where('register_id', $list->requested_id)->get();
      foreach ($getUser as $list1) {
        $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$list1->image ? 'https://ap-group.us/arttales/public/images/register/' . $list1->image : '';
        $array1['name']   =    @$list1->name ? $list1->name : '';
        // $array1['major_achive']   =    @$list->major_achive ? $list->major_achive : '';
        array_push($array2, $array1);
      }
    }
    return $array2;
  }

  public function unfollowuser($data)
  {
    $connection = Connection::find($data['connection_id']);
    $connection->register_id =  $data['register_id'];
    $connection->requested_id = $data['requested_id'];
    $connection->vConnection = "Unfollow";
    $connection->save();
    $connection['code'] = 200;
    return $connection;
  }

  public function block($data)
  {
    $user = new Connection;
    $user->register_id       = $data['register_id'];
    $user->requested_id      = $data['requested_id'];
    $user->is_block          = "Block";
    $user->save();



    return $user;
  }

  public function blockListing($data)
  {
    $getDetails = Connection::where('register_id', $data)
      ->where('connections.is_block', 'Block')->get();
    $array1 = array();
    $array2 = array();
    foreach ($getDetails as $list) {
      $array1['register_id'] = @$list->register_id ? $list->register_id : '';
      $array1['requested_id'] = @$list->requested_id ? $list->requested_id : '';
      $getUser = User::where('register_id', $list->requested_id)->get();
      foreach ($getUser as $list1) {
        $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$list1->image ? 'https://ap-group.us/arttales/public/images/register/' . $list1->image : '';
        $array1['name']   =    @$list1->name ? $list1->name : '';
        // $array1['major_achive']   =    @$list->major_achive ? $list->major_achive : '';
        array_push($array2, $array1);
      }
    }
    return $array2;
  }

  public function unblockuser($data)
  {
    $connection = Connection::find($data['connection_id']);
    $connection->register_id  =  $data['register_id'];
    $connection->requested_id = $data['requested_id'];
    $connection->is_block     = "Unblock";
    $connection->save();
    $connection['code'] = 200;
    return $connection;
  }



  public function tagListing()
  {
    $array1 = array();
    $array2 = array();

    $fetch_user = Connection::leftjoin('users', 'users.register_id', 'connections.requested_id')
      ->where('vConnection', 'Following')
      ->get();
    foreach ($fetch_user as $user) {

      $array1['register_id']  = @$user->register_id ? $user->register_id  : '';
      $array1['name']         = @$user->name ? $user->name  : '';
      $array1['image']        = 'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image  : '';
      //$array1['vConnection']  = @$user->vConnection ?$user->vConnection : '';
      $array1['major_achive']  = @$user->major_achive ? $user->major_achive : '';
      array_push($array2, $array1);
    }
    return $array2;
  }

  public function post($data, $type)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";
    $image = $data['post_image'] ?? null;
    if ($image != null) {
      $image = $CustomVerfication->imageUpload($image, $path);
    } else {
      $image = null;
    }
    $tags[] = $data['tags'] ?? null;

    $user = new Post;
    $user->post_image        = $image;
    $user->descriptions      = $data['descriptions'];
    $user->tags              = implode(',', $tags);
    $user->type              = $data['type'];
    $user->register_id       = $data['register_id'];
    //$user->product_id      = $data['product_id'];
    $user->post_type         = 'Image';
    $user->save();
    if ($type == 1) {
      if (isset($data['product_image'])) {
        foreach ($data['product_image'] as $file) {
          $image = $file ?? null;
          if ($image != null) {
            $imagedata[] = $CustomVerfication->imageUpload($image, $path);
          } else {
            $imagedata = null;
          }
        }
      }
      $user1 = new Product;
      $user1->product_name         = $data['product_name'];
      $user1->price                = $data['price'];
      $user1->discount             = $data['discount'];
      $user1->offer_price          = $data['offer_price'];
      $user1->product_image        = implode(',', $imagedata);
      $user1->product_description  = $data['product_description'];
      $user1->limited_stock        = $data['limited_stock'];
      $user1->sell_product         = $data['sell_product'];
      $user1->post_id              = $user->post_id;
      $user1->save();

      $post = Post::where('post_id', $user->post_id)->first();
      $post->product_id = $user1->product_id;
      $post->save();
    }
    return $user;
  }

  public function postvideo($data, $type)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";
    $image = $data['post_image'] ?? null;
    if ($image != null) {
      $image = $CustomVerfication->imageUpload($image, $path);
    } else {
      $image = null;
    }
    $tags[] = $data['tags'] ?? null;

    $user = new Post;
    $user->post_image        = $image;
    $user->descriptions      = $data['descriptions'];
    $user->tags              = implode(',', $tags);
    $user->type              = $data['type'];
    $user->register_id       = $data['register_id'];
    $user->post_type         = 'Video';
    $user->save();
    if ($type == 1) {
      if (isset($data['product_image'])) {
        foreach ($data['product_image'] as $file) {
          $image = $file ?? null;
          if ($image != null) {
            $imagedata[] = $CustomVerfication->imageUpload($image, $path);
          } else {
            $imagedata = null;
          }
        }
      }
      $user1 = new Product;
      $user1->product_name         = $data['product_name'];
      $user1->price                = $data['price'];
      $user1->discount             = $data['discount'];
      $user1->offer_price          = $data['offer_price'];
      $user1->product_image        = implode(',', $imagedata);
      $user1->product_description  = $data['product_description'];
      $user1->limited_stock        = $data['limited_stock'];
      $user1->sell_product         = $data['sell_product'];
      $user1->post_id              = $user->post_id;
      $user1->save();

      $post = Post::where('post_id', $user->post_id)->first();
      $post->product_id = $user1->product_id;
      $post->save();
    }
    return $user;
  }



  public function getAllPoet()
  {
    $PoetList = Poet::get();
    return $PoetList;
  }

  public function post_like($data)
  {
    $register_id = $_POST['register_id'];
    $post_id = $_POST['post_id'];

    $getUsers = post_like::where('post_id',$post_id)->where('register_id',$register_id)->get();
    $count = count($getUsers);
    if ($count > 0) {
      $getUsers1 = post_like::where('post_id',$post_id)->where('register_id',$register_id)->first();
      $getUsers1->is_like = 1;
      $getUsers1->save();
    } else {
      $user = new post_like;
      $user->register_id = $data['register_id'];
      $user->post_id = $data['post_id'];
      $user->is_like = 1;
      $user->save();

      $notification = new send_notifications;
      $notification->register_id             = $data['register_id'];
      $notification->post_id         = $data['post_id'];

      $notification->notification_to         = $data['register_id'];
      $notification->notification_type       = "Send Request";
      $notification->notification_time       = date('Y-m-d H:i:s');
      $notification->notification_text       = 'Send Request';
      $notification->save();
    }
    return $getUsers;
  }

  public function post_unlike($data)
  {
    $getUsers = post_like::where("id", $data)->first();
    $getUsers->is_like =  0;
    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;

    return $userdata;
  }

  public function favorite_post($data)
  {
    $register_id = $_POST['register_id'];
    $post_id = $_POST['post_id'];

    $getUsers = favorite_post::where('post_id',$post_id)->where('register_id',$register_id)->get();
    $count = count($getUsers);
    if ($count > 0) {
      $getUsers1 = favorite_post::where('post_id',$post_id)->where('register_id',$register_id)->first();
      $getUsers1->is_favorite = 1;
      $getUsers1->save();
    } else {
      $user = new favorite_post;
      $user->register_id = $data['register_id'];
      $user->post_id = $data['post_id'];
      $user->is_favorite = 1;
      $user->save();
    }
    return $getUsers;
  }

  public function favorite_post_listing()
  {
    if (isset($_POST['register_id'])) {
      $register_id  = $_POST["register_id"];
      // $product_id  = $_POST["product_id"];
      //$post_id  = $_POST["post_id"];
      $array1 = array();
      $array2 = array();
      $getDetails = favorite_post::where('register_id', $register_id)->get();
      // dd($getDetails);
      // $getDetailsProduct = Comment::where('product_id', $product_id)->get();
      if ($getDetails) {
        foreach ($getDetails as $list) {
          $userId = $list->register_id;
          $post_id = $list->post_id;
          $post_date   = $list['created_at']; // your date or time coming from notification
          $seconds_ago = (time() - strtotime($post_date));

          if ($seconds_ago >= 31536000) {
            $final_time =  intval($seconds_ago / 31536000) . " years ago";
          } elseif ($seconds_ago >= 2419200) {
            $final_time = intval($seconds_ago / 2419200) . " months ago";
          } elseif ($seconds_ago >= 86400) {
            $final_time =  intval($seconds_ago / 86400) . " days ago";
          } elseif ($seconds_ago >= 3600) {
            $final_time = intval($seconds_ago / 3600) . " hours ago";
          } elseif ($seconds_ago >= 60) {
            $final_time = intval($seconds_ago / 60) . " minutes ago";
          } else {
            $final_time = $seconds_ago . " Seconds ago";
          }

          $currentDateTime = $list['created_at'];;
          $newDateTime = date('h:i A', strtotime($currentDateTime));
          $array1['favorite_post_id'] = @$list->id ? $list->id : '';
          $getPost = Post::where('post_id', $post_id)->get();
          foreach ($getPost as $post) {
            $registerId = $post->register_id;
            $array1['post_id'] = @$post->post_id ? $post->post_id : '';
            $array1['post_image']   =    'https://ap-group.us/arttales/public/images/register/' . @$post->post_image ? 'https://ap-group.us/arttales/public/images/register/' . $post->post_image : '';
            $array1['descriptions'] = @$post->descriptions ? $post->descriptions : '';
          }
          $getUser = User::where('register_id', $registerId)->get();
          foreach ($getUser as $user) {
            $array1['register_id'] = @$user->register_id ? $user->register_id : '';
            $array1['name'] = @$user->name ? $user->name : '';
            $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
            $array1['day']         =  $final_time;
            $array1['time']        =  $newDateTime;
            array_push($array2, $array1);
          }
        }
      }
      return $array2;
    }
  }



  public function searchUserListing()
  {
    $data =   new DataService();
    $searchUserList = User::where('register_id', '!=', 'register_id')->get();
    $searchUser = array();
    $data->searchUserListData = array();
    foreach ($searchUserList as $list) {

      $searchUser['register_id']  =  @$list->register_id ? $list->register_id : '';
      $searchUser['name']         =  @$list->name        ? $list->name : '';
      $searchUser['image']         =  'https://ap-group.us/arttales/public/images/register/' . @$list->image ? 'https://ap-group.us/arttales/public/images/register/' . $list->image : '';
      $searchUser['major_achive'] =  @$list->major_achive ? $list->major_achive : '';

      array_push($data->searchUserListData, $searchUser);
    }
    return $data->searchUserListData;
  }



  public function dashboardListing($data)
  {
    $register_id = $_POST['register_id'];
    $getPost = Post::where('posts.register_id', '!=', $register_id)->get();

    $array1 = array();
    $array2 = array();

    foreach ($getPost as $post) {
      $post_date   = $post['created_at']; // your date or time coming from notification
      $seconds_ago = (time() - strtotime($post_date));

      if ($seconds_ago >= 31536000) {
        $final_time =  intval($seconds_ago / 31536000) . " years ago";
      } elseif ($seconds_ago >= 2419200) {
        $final_time = intval($seconds_ago / 2419200) . " months ago";
      } elseif ($seconds_ago >= 86400) {
        $final_time =  intval($seconds_ago / 86400) . " days ago";
      } elseif ($seconds_ago >= 3600) {
        $final_time = intval($seconds_ago / 3600) . " hours ago";
      } elseif ($seconds_ago >= 60) {
        $final_time = intval($seconds_ago / 60) . " minutes ago";
      } else {
        $final_time = $seconds_ago . " Seconds ago";
      }

      $currentDateTime = $post['created_at'];;
      $newDateTime = date('h:i A', strtotime($currentDateTime));

      $array1['post_id']     = $post->post_id;
      $array1['post_image']  =  'https://ap-group.us/arttales/public/images/register/' . @$post->post_image ? 'https://ap-group.us/arttales/public/images/register/' . $post->post_image : '';
      $array1['product_id']  =  @$post->product_id ? $post->product_id : '';
      $array1['day']         =  $final_time;
      $array1['time']        =  $newDateTime;
      $array1['type']        =  @$post->type ? $post->type   : '';
      $array1['register_id'] =  @$post->register_id ? $post->register_id : '';
      $getpost_like = post_like::where('post_id', $post->post_id)->where('is_like', '=', '1')->get();
      $count = count($getpost_like);
      $array1['like_count']     =  $count;
      $getpost_comment = Comment::where('post_id', $post->post_id)->get();
      $count3 = count($getpost_comment);
      $array1['comment']     =  $count3;
      $array1['post_type']   = $post->post_type;


      $getUser = User::where('register_id', $post->register_id)->get();

      foreach ($getUser as $user) {
        $is_likeQuery = post_like::where('post_id', $post->post_id)->where('register_id', $user->register_id)->where('is_like', '=', '1')->get();
        //dd($is_likeQuery);
        $count2 = count($is_likeQuery);
        if ($count2 > 0) {
          $is_like = 1;
        } else {
          $is_like = 0;
        }
        $array1['is_like'] = $is_like;

        $is_favoriteQuery = favorite_post::where('post_id', $post->post_id)->where('register_id', $user->register_id)->where('is_favorite', '=', '1')->get();
        //dd($is_favoriteQuery);
        $count4 = count($is_favoriteQuery);
        if ($count4 > 0) {
          $is_favorite = 1;
        } else {
          $is_favorite = 0;
        }
        $array1['is_favorite']  = $is_favorite;
        $array1['name']        =  @$user->name  ? $user->name : '';
        $array1['image']       =  'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';

        array_push($array2, $array1);
      }
    }
    return $array2;
  }



  public function fetchUser($data)
  {

    if (isset($data['register_id'])) {
      $getUsers = User::getUser($email = null, $data['register_id']);
      $acesstoken = $this->access_token;
    }
    if (isset($getUsers)) {
      $userdata['register_id']  =   $getUsers->register_id;
      $userdata['name']          =   $getUsers->name ?   $getUsers->name : '';
      $userdata['country_code'] =   $getUsers->country_code ?   $getUsers->country_code : '';
      $userdata['mobile']        =   $getUsers->mobile ?   $getUsers->mobile : '';
      $userdata['dob']           =    $getUsers->dob ? $getUsers->dob : '';
      $userdata['email']         =   $getUsers->email   ?   $getUsers->email : '';
      $userdata['image']         =   $getUsers->image   ?   $getUsers->image : '';
      $userdata['bio']           =   $getUsers->bio   ?  $getUsers->bio : '';
      $userdata['website']       =    $getUsers->website ? $getUsers->website : '';
      $userdata['major_achive'] =    $getUsers->major_achive ? $getUsers->major_achive : '';
      $userdata['genres']       =    $getUsers->genres ? $getUsers->genres : '';
      $userdata['work_at']       =    $getUsers->work_at ? $getUsers->work_at : '';
      $userdata['performance']   =    $getUsers->performance ? $getUsers->performance : '';
      $userdata['visiting_card'] =   $getUsers->visiting_card   ?   $getUsers->visiting_card : '';
      $userdata['access_token'] =   $acesstoken;
      $userdata['role']         =   $getUsers->role   ?   $getUsers->role : '';
    } else {

      $userdata['code'] = 461;
    }

    return $userdata;
  }



  public function getAllPefrence()

  {
    $preferenceList = Preference::get();
    return $preferenceList;
  }

  public function getAllFaq()
  {
    $faqList = Faq::get();
    return $faqList;
  }

  public function contact($data)
  {


    $user = new Contact;

    $user->name                = $data['name'];
    $user->email               = $data['email'];
    $user->message              = $data['message'];


    $user->save();

    return $user;
  }

  public function registerStore($data)
  {
    $CustomVerfication = new CustomVerfication;
    $path = "register";
    $image = $data['store_image'] ?? null;
    if ($image != null) {
      $image = $CustomVerfication->imageUpload($image, $path);
    } else {
      $image = null;
    }

    $attachment = $data['attachment'] ?? null;
    if ($attachment != null) {
      $attachment = $CustomVerfication->imageUpload($attachment, $path);
    } else {
      $attachment = null;
    }
    $stores = new Store;

    $stores->store_name  = $data['store_name'];
    $stores->category  = $data['category'];
    $stores->mobile = $data['mobile'];
    $stores->email = $data['email'];
    $stores->website = $data['website'];
    $stores->address = $data['address'];
    $stores->register_id = $data['register_id'];
    $stores->attachment = $attachment;
    $stores->store_image = $image;

    $stores->save();
    return $stores;
  }

  public function storlisting()
  {
    $data =   new DataService();
    $storlisting = Store::where('store_id', '!=', 'store_id')->get();
    $searchUser = array();
    $data->searchUserListData = array();
    foreach ($storlisting as $list) {

      $searchUser['store_id']  =  @$list->store_id ? $list->store_id : '';
      $searchUser['store_name']         =  @$list->store_name        ? $list->store_name : '';
      $searchUser['store_image']         =  'https://ap-group.us/arttales/public/images/register/' . @$list->store_image ? 'https://ap-group.us/arttales/public/images/register/' . $list->store_image : '';
      $searchUser['category'] = @$list->category ? $list->category : '';
      $searchUser['address'] = @$list->address ? $list->address : '';
      $searchUser['category'] = @$list->category ? $list->category : '';
      $searchUser['attachment'] =  @$list->attachment ? $list->attachment : '';

      array_push($data->searchUserListData, $searchUser);
    }
    return $data->searchUserListData;
  }

  public function savepost($data)
  {
    $stores = new Savepost;

    $stores->register_id  = $data['register_id'];
    $stores->post_id = $data['post_id'];

    $stores->save();
    return $stores;
  }

  public function postComment($data)
  {
    $stores = new Comment;
    $stores->register_id  = $data['register_id'];
    $stores->request_id  = $data['request_id'];
    $stores->post_id = $data['post_id'];
    $stores->product_id = $data['product_id'];
    $stores->comment = $data['comment'];
    $stores->tag  = $data['tag'];
    $stores->save();
    return $stores;
  }

  public function commentListing()
  {
    if (isset($_POST['register_id'])) {
      $register_id  = $_POST["register_id"];
      $product_id  = $_POST["product_id"];
      $post_id  = $_POST["post_id"];

      $array1 = array();
      $array2 = array();
      $getDetails = Comment::where('post_id', $post_id)->orderBy('id', 'DESC')->get();
      $getDetailsProduct = Comment::where('product_id', $product_id)->get();
      if ($getDetails) {
        foreach ($getDetails as $list) {
          $userId = $list->register_id;
          $array1['post_id'] = @$list->post_id ? $list->post_id : '';
          $array1['Comment'] = @$list->Comment ? $list->Comment : '';
          $getUser = User::where('register_id', $userId)->get();
          foreach ($getUser as $user) {
            $array1['name'] = @$user->name ? $user->name : '';
            $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
            array_push($array2, $array1);
          }
        }
      }
      if ($getDetailsProduct) {
        foreach ($getDetailsProduct as $list1) {
          $userId = $list1->register_id;
          $array1['product_id'] = @$list1->product_id ? $list1->product_id : '';
          $array1['Comment'] = @$list1->Comment ? $list1->Comment : '';
          $getUser = User::where('register_id', $userId)->get();
          foreach ($getUser as $user) {
            $array1['name'] = @$user->name ? $user->name : '';
            $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
            array_push($array2, $array1);
          }
        }
      }
      return $array2;
    }
  }

  public function comment_like($data)
  {

    $user = new comment_like;
    $user->register_id = $data['register_id'];
    $user->comment_id = $data['comment_id'];
    $user->is_like = 1;
    $user->save();

    return $user;
  }



  public function savepostlisting()
  {
    if (isset($_POST['register_id'])) {
      $register_id  = $_POST["register_id"];
      // $product_id  = $_POST["product_id"];
      //$post_id  = $_POST["post_id"];
      $array1 = array();
      $array2 = array();
      $getDetails = Savepost::where('register_id', $register_id)->get();
      // dd($getDetails);
      // $getDetailsProduct = Comment::where('product_id', $product_id)->get();
      if ($getDetails) {
        foreach ($getDetails as $list) {
          $userId = $list->register_id;
          $post_id = $list->post_id;
          $array1['save_post_id'] = @$list->id ? $list->id : '';
          $getPost = Post::where('post_id', $post_id)->get();
          foreach ($getPost as $post) {
            $registerId = $post->register_id;
            $array1['post_id'] = @$post->post_id ? $post->post_id : '';
            $array1['post_image']   =    'https://ap-group.us/arttales/public/images/register/' . @$post->post_image ? 'https://ap-group.us/arttales/public/images/register/' . $post->post_image : '';
            $array1['descriptions'] = @$post->descriptions ? $post->descriptions : '';
          }
          $getUser = User::where('register_id', $registerId)->get();
          foreach ($getUser as $user) {
            $array1['register_id'] = @$user->register_id ? $user->register_id : '';
            $array1['name'] = @$user->name ? $user->name : '';
            $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
            array_push($array2, $array1);
          }
        }
      }
      return $array2;
    }
  }

  public function review($data)
  {
    $stores = new Review;

    $stores->register_id  = $data['register_id'];
    $stores->product_id = $data['product_id'];
    $stores->review = $data['review'];

    $stores->save();
    return $stores;
  }

  public function reviewlist()
  {
    if (isset($_POST['product_id'])) {
      $product_id  = $_POST["product_id"];
      // $product_id  = $_POST["product_id"];
      //$post_id  = $_POST["post_id"];
      $array1 = array();
      $array2 = array();
      $getDetails = Review::where('product_id', $product_id)->get();
      // dd($getDetails);
      // $getDetailsProduct = Comment::where('product_id', $product_id)->get();
      if ($getDetails) {
        foreach ($getDetails as $list) {
          $array1['Review_id'] = @$list->id ? $list->id : '';
          $array1['product_id'] = @$list->product_id ? $list->product_id : '';
          $array1['Review'] = @$list->review ? $list->review : '';
          $register_id = $list->register_id;
          $getUser = User::where('register_id', $register_id)->get();
          foreach ($getUser as $user) {
            $array1['register_id'] = @$user->register_id ? $user->register_id : '';
            $array1['name'] = @$user->name ? $user->name : '';
            $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
            array_push($array2, $array1);
          }
        }
      }
      return $array2;
    }
  }

  public function cart($data)
  {
    $stores = new cart();

    $stores->register_id  = $data['register_id'];
    $stores->product_id = $data['product_id'];
    $stores->store_id = $data['store_id'];
    $stores->price = $data['price'];
    $stores->discount = $data['discount'];
    $stores->quantity  = $data['quantity'];
    $stores->save();
    return $stores;
  }


  public function cartlist()
  {
    if (isset($_POST['register_id'])) {
      $register_id  = $_POST["register_id"];
      // $product_id  = $_POST["product_id"];
      //$post_id  = $_POST["post_id"];
      $array1 = array();
      $array2 = array();
      $getDetails = cart::where('register_id', $register_id)->get();
      //dd($getDetails);

      if ($getDetails) {
        foreach ($getDetails as $list) {
          $product_id = $list->product_id;
          $getDetailsProduct = Product::where('product_id', $product_id)->get();
          $array1['Cart_id'] = @$list->id ? $list->id : '';
          $array1['store_id'] = @$list->store_id ? $list->store_id : '';
          $array1['product_id'] = @$list->product_id ? $list->product_id : '';
          foreach ($getDetailsProduct as $list1) {
            $array1['Product_name'] = @$list1->product_name ? $list1->product_name : '';
            $array1['product_image']   =    'https://ap-group.us/arttales/public/images/register/' . @$list1->product_image ? 'https://ap-group.us/arttales/public/images/register/' . $list1->product_image : '';
            $array1['Price'] = @$list->price ? $list->price : '';
            $array1['Discount'] = @$list->discount ? $list->discount : '';
            $array1['Quantity'] = @$list->quantity ? $list->quantity : '';
            $register_id = $list->register_id;
            $getUser = User::where('register_id', $register_id)->get();
            foreach ($getUser as $user) {
              $array1['register_id'] = @$user->register_id ? $user->register_id : '';
              $array1['name'] = @$user->name ? $user->name : '';
              $array1['image']   =    'https://ap-group.us/arttales/public/images/register/' . @$user->image ? 'https://ap-group.us/arttales/public/images/register/' . $user->image : '';
              array_push($array2, $array1);
            }
          }
        }
      }
      return $array2;
    }
  }

  public function delete_cart($data)
  {
    $getUsers = cart::where("id", $data)->delete();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;
    return $userdata;
  }

  // public function buy_now($data)
  // {

  //   $userOrder = new Order;
  //   $userOrder->user_id           = $data['user_id'];
  //   $userOrder->shipping_address  = $data['shipping_address'];
  //   $userOrder->code = date('Ymd-His') . rand(10, 99);
  //   $userOrder->date = strtotime('now');
  //   $userOrder->save();

  //   $userId = $userOrder->user_id;

  //   $orderList = Order::where('user_id', $userId)->get();
  //   foreach ($orderList as $order) {
  //     $orderId = $order->id;
  //   }

  //   $buyCart = new OrderDetail;
  //   $buyCart->seller_id = $data['user_id'];
  //   $buyCart->shop_id = $data['shop_id'];
  //   $buyCart->product_id = $data['product_id'];
  //   $buyCart->price = $data['price'];
  //   $buyCart->discount = $data['discount'];
  //   $buyCart->tax = $data['tax'];
  //   $buyCart->quantity = $data['quantity'];
  //   $buyCart->shipping_cost = $data['shipping_cost'];
  //   $buyCart->order_id        = $orderId;
  //   $buyCart->save();

  //   $select_id = OrderDetail::where('seller_id', '=', $userId)
  //     ->sum('price');

  //   $discount = OrderDetail::where('seller_id', '=', $userId)
  //     ->sum('discount');

  //   $qty = OrderDetail::where('seller_id', '=', $userId)
  //     ->sum('quantity');

  //   $count_notification  = ($select_id * $qty) - $discount;

  //   $getUsers = Order::where('user_id', $userId)->first();
  //   $getUsers->grand_total   =  $count_notification;
  //   $getUsers->save();

  //   date_default_timezone_set('Asia/Kolkata');
  //   $notification = new User_notification;
  //   $notification->order_id               = $orderId;
  //   $notification->NotificationTo         = $userId;
  //   $notification->NotificationType       = "Order Placed";
  //   $notification->NotificationDateTime   =  date('Y-m-d H:i:s');
  //   $notification->NotificationText       = 'Your order has been placed Order-ID' . ' - ' . $userOrder->code;
  //   $notification->save();

  //   return $userOrder;
  // }

  public function donotdisturb($data)
  {
    $getUsers = User::where("register_id", $data)->first();
    $getUsers->do_not_disturb =  1;
    $getUsers->save();
    //$userdata['device_token']  =   $getUsers->device_token;
    $userdata['code'] = 200;
    return $userdata;
  }

  public function notificationListing($data){
     
    if(isset($data)){
      $getDetails = send_notifications::where('register_id',$data)->get();
      
    }
    $array1 = array();
    $array2 = array();

    foreach($getDetails as $list){

      $array1['notification'] = @$list->notification ? $list->notification : '';
      $array1['notification_image'] 	=  	'https://ap-group.us/arttales/public/images/register/'.@$list->notification_image ? 'https://ap-group.us/arttales/public/images/register/'.$list->notification_image : '';
      $array1['register_id'] = @$list->register_id ? $list->register_id : '';
      
    
      array_push($array2,$array1);
    }
    return $array2;

      
}
}
