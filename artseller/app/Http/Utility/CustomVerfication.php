<?php
namespace App\Http\Utility;
use Twilio\Rest\Client;
final class CustomVerfication{

	public static  function generateRandomNumber(){

		$number = rand(1000 , 9999 );
		return $number;	
	}	

	// public static function phoneVerification($message, $recipients){

	// 	$account_sid = getenv("TWILIO_SID");
 //    	$auth_token = getenv("TWILIO_AUTH_TOKEN");
 //    	$twilio_number = getenv("TWILIO_NUMBER");
 //    	$client = new Client($account_sid, $auth_token);
 //    	$client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message] );

	// } 
	
	public function imageUpload($image,$pathName){

		//$filesize = filesize($image);
		$fileName = $image->getClientOriginalName();
		$fileExtension = $image->getClientOriginalExtension();
		$fileName = 'image'.rand(11111, 99999) . '.' . $fileExtension;
		$destinationPath = 'public/images/'.$pathName;
		$upload_success = $image->move($destinationPath, $fileName);
		$images = $fileName;


		return $images;
	}
}
