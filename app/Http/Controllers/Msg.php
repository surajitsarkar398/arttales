<?php 

namespace App\Http\Controllers;

final class Msg{

	function responseMsg($msgId){

	  $msg = array();
	  $msg[200] = 'Login successful.';
	  $msg[201] = 'Username available.';
	  $msg[203] = 'Congratulations! Your account has been created. Please check your email/phone which has OTP.';
	  $msg[204] = 'Congratulations! You successfully changed your password.';
	  $msg[205] = 'Congratulations! You successfully verified and now you can login your account.';
	  $msg[206] = 'Terms and condition accepted.';
	  $msg[207] = 'User profile.'; 
	  $msg[208] = 'Profile updated successfully.';
	  //$msg[209] = 'An SMS has been sent to you with a verification code. Please use that code to verify your account and complete the registration process.';
	  $msg[209] = 'Your account is not verified. Please check your phone message inbox for the verification link.';
	  $msg[210] = 'You successfully added your boat.';
	  $msg[211] = 'Country list.';
	  $msg[212] = 'Subscription plan list.';
	  $msg[214] = 'Specialist list.';
	  $msg[216] = 'Logout successful.';
	  $msg[217] = 'Profile updated successfully.';
	  $msg[218] = 'Image/video updated successfully.';
	  $msg[227] = 'Logout successful.';
	  $msg[236] = 'Notification deleted.';
	  $msg[237] = 'Your registration is successful. You can now login into the app.';
	  $msg[248] = 'User deleted successfully.';
	  $msg[252] = 'Thanks, we\'ve successfully added your review!';
	  $msg[262] = 'User dashboard.';
	  $msg[272] = 'User verified successfully.';
	  $msg[273] = 'User details.';
	  $msg[274] = 'User details updated successfully.';
	  $msg[275] = 'Please verify your account. To verify your account check your email for verification code.';
	  $msg[276] = 'Unread count.';
	  $msg[277] = 'Notification list.';
	  $msg[278] = 'Message Sent.';
	  $msg[279] = 'User  registered successfully.';
	  $msg[288] = 'Page list.';
	  $msg[293] = 'App version check.';
	  $msg[297] = 'All details updated successfully.';
	  $msg[299] = 'Review List.';
	  $msg[300] = 'Doctor List.';
	 


	  $msg[400] = 'Please provide a valid verification code.';
	  $msg[401] = 'Incorrect username or password.';
	  //$msg[402] = 'Please verify your account. To verify your account please check your email for verification code.';
	  $msg[402] = 'Your account is still pending verification.  Please check your email (including Spam/Junk folders) and follow the instructions to verify your account.';
	  $msg[403] = 'Please provide all required fields.';
	  $msg[404] = 'User is not verified.';
	  $msg[405] = 'Error in updating user details.';
	  $msg[406] = 'invalid parameter';
	  $msg[407] = 'No contact found';
	  $msg[408] = 'User registration failed';
	  $msg[409] = 'Accepted image formats - png, jpg and jpeg';
	  $msg[410] = 'The email address you have entered already exists.';
	  $msg[411] = 'The email / phone or password you have entered is incorrect. Please check and try again';
	  $msg[412] = 'Your current password is incorrect. Please check and try again.';
	  $msg[413] = 'User token required';
	  $msg[414] = 'Sorry, your session seems to have expired.';
	  $msg[415] = 'Password and confirm password should be same.';
	  $msg[416] = 'Error in save new password';
	  $msg[417] = 'Error in receiver details.';
	  $msg[418] = 'Fill all required parameter.';
	  $msg[419] = 'This account isn\'t verified';
	  $msg[420] = 'New password cannot be the same as the old password';
	  $msg[421] = 'This email id has already been registered';
	  $msg[422] = 'Invalid code';
	  $msg[423] = 'There was some problem while processing your request. Please try again later.';
	  $msg[424] = 'No role added yet in your account.';
	  $msg[425] = 'Result not found';
	  $msg[426] = 'This record does not exist.';
	  $msg[427] =  'The credentials you entered are incorrect. Please check and try again.';
	  $msg[428] = 'You have already mark as intrested.';
	  $msg[430] = 'The email and password you entered is incorrect. ';
	  $msg[431] = 'The email address you entered is already in use within the system.  If this is your email address, but you cannot remember your login credentials, please use the forgot username and password prompts to reset your account.  If you are trying to create a new role for yourself, login with your existing username and password, then select "Switch/Add Role" from the More tab. If you did not create an account but your email address is in use, please contact us immediately at support@firstmateservices.com.';
	  $msg[434] = 'Invalid input.';
	  $msg[435] = 'Failed to add users.';
	  $msg[445] = 'No notifications found';
	  $msg[446] = 'No image exists';
	  $msg[461] = 'Invalid user';
	  $msg[462] = 'You don’t have access to this chat.';
	  $msg[463] = 'You have noet received any message.';
	  $msg[468] = 'User verification request failed.';
	  $msg[469] = 'User details update request failed.';
	  $msg[470] = 'Password reset request failed';
	  $msg[472] = 'Transaction failed.';
	  $msg[473] = 'You previously received an email invitation to join xtract, which was just resent to you. Please check your email (including Spam and Junk folders) and click on the link in the email to complete the registration process. This ensures that the person who invited you  gets credit for a discount in the system.';
	  $msg[497] = 'Invalid request';
	  //$msg[498] = 'Account has been deleted';
	  $msg[498] = 'Your account has been deactivated by the xtract administrator.';
	  $msg[499] = 'Email address and username provided are already registered with us.';
	 
	  $msg[500] = 'The email you entered already exists in the system. If you are trying to create a account for yourself, login with your existing email/phone and password from the login section. Otherwise, please try using a different email to create your account.';
	 
	  $msg[501] = 'The phone you entered already exists in the system. If you are trying to create a account for yourself, login with your existing email/phone and password from the login section. Otherwise, please try using a different phone to create your account.';
	 
	  $msg[502] = 'A verification code has been sent to your email address. Please use the verification code to verify your email address.';
	  $msg[503] = 'A verification code has been sent to your phone number. Please use the verification code to verify your phone number.';
	  $msg[504] = 'It seems that this email id is associated with another username. If you are that user, please login and again tap the link.';
	  $msg[505] = 'Email address provided is already registered with us. Please use new email address for you new registered company account.';
	  $msg[506] = 'Sorry, you can not add this role as you are already associated with this company in some other role.';
	  $msg[507] = 'Sorry, this email address/phone no is not registered with us. Please check to make sure you entered it correctly, or try a different email address/ phone no.';
	  $msg[508] = 'You cannot access this page because your role is currently awaiting approval. You will be notified as soon as approval is complete.';
	  $msg[509] = 'A verification link has been sent to your email address. Please use the verification link to verify your email address.';
	  $msg[510] = 'You need to first complete all ongoing projects to dispose the company.'; 
	  $msg[511] = 'You don’t have the permission to delete the company.'; 
	  $msg[512] = 'This boat has one or more active projects, please complete them before disposing the boat.';
	  $msg[513] = 'You need to first complete all ongoing projects of this boat to dispose this boat.';
	  $msg[514] = 'Your project is not yet saved as a draft.'; 
	  $msg[515] = 'No reviews added yet.'; 
	  $msg[516] = 'This ACH account is already registered in the system.'; 
	  $msg[517] = 'You are already listed as the owner for this boat, therefore you do not need to be added as the Boat Manager.'; 
	  $msg[518] = 'No cards added yet.'; 
	  $msg[519] = 'You are already listed as the owner for this boat, therefore you cannot sell it to yourself.'; 
	  $msg[520] = 'Problem occurred in adding card.'; 
	  $msg[521] = 'You cannot become a manager on your own boat.';
	  $msg[522] = 'Sorry, you have not added any boats to your profile yet. You can add a boat by selecting the Add Boat option in the More tab.'; 
	  $msg[523] = 'Please check and update your company details at least once before submitting your first invoice.';
	  $msg[524] = 'The company has not set up a bank account to receive payments yet.  Please contact the company immediately to ensure they set up an account.'; 
	  $msg[525] = 'You have already sold this company to someone else.'; 
	  $msg[526] = 'You have already sold this boat to someone else.'; 
	  $msg[527] = 'A quotation has already been accepted for this project.'; 
	  $msg[528] = 'The invoice has already been accepted for this project.'; 
	  $msg[529] = 'This is user already assigned as a service provider owner for this company.'; 
	  $msg[530] = 'This is user already assigned as a service provider employee for this company.'; 

	  $msg[601] = 'An OTP sent to your registered email address/ phone no.. Please use that OTP to verify your account, then follow the instructions to reset your password.'; 
	  $msg[602] = 'An OTP sent to your registered phone number. Please use that OTP to verify your account, then follow the instructions to reset your password.';
	  $msg[603] = 'Your username has been sent to the email address you entered. Please check it and try again.'; 
	  $msg[604] = 'Your username has been sent to the phone number you entered. Please check it and try again.'; 
	  $msg[605] = 'Please add at least one boat first.'; 
	  $msg[606] = 'This email address is already in use for an existing company.  Please use a different email to set up different companies to avoid mixing up customer data and payments.  If you have questions, please contact us at support@firstmateservices.com.'; 
	  $msg[607] = 'If this is your username then login to add a new role from "More" ta.b'; 
	  //$msg[504] = 'Your account is not verified. Please check your email for the verification code.';
	  $msg[608] = 'Sorry, you can not add this role as you are already associated with this boat in some other role.';
	  $msg[609] = 'Sorry, referral code not exists.';
	  $msg[610] = 'Payment list empty.';
	  $msg[611] = 'Sorry! The invitation link you clicked has already been consumed for creating another user account. Please click an unused invitation link or use fresh signup option by going back to the login screen.';
	  $msg[612] = 'Sorry! The invitation link you clicked has already been consumed for creating another user account. Please click an unused invitation link or use fresh signup option by going back to the login screen.';
	  $msg[613] = 'Sorry, you need to enter your company`s identity information in order to receive payments. Do you wish to add that now?';
	  $msg[614] = 'Sorry, you need to enter your company`s identity information in order to receive payments. Do you wish to add that now?';
	  /*$msg[613] = 'Sorry, you need to enter your companys identity information in order to receive payments.  Please go to More/Profile Settings/Identity Information and select Add Missing Details to enable payments.';
	  $msg[614] = 'Sorry! It seems your identity information is not complete hence your account is unable to receive payments. Please add missing Identity Information from Profile Settings before submitting invoice.';*/
	  $msg[615] = 'You are already listed as the owner for this company, therefore you cannot sell it to yourself.';
	  $msg[616] = 'This user is already assigned as a service provider employee for this company.';
	  $msg[617] = 'Sorry! It seems you cannot add this role because it has already been associated with some other user. Please contact the sender or admin if you find this is incorrect or if you want to merge your 2 different accounts.';
	  $msg[618] = 'You cannot delete this location becuase it is currently associated with an active project.';
	  $msg[619] = 'Card already delted successfully.';
	  $msg[620] = 'Assignment already cancelled';
	  $msg[621] = 'Assignment already assigned';
	  $msg[622] = 'It seems your Sp information is not complete. Please go to the Sp Info section and fill all the details before proceeding. If the problem persists please contact xtract Admin.';
	  $msg[623] = 'You did not accept any quotes for this project, so it will be marked as declined. You can view it in the Projects menu under the Declined tab.';
	  $msg[624] = 'Boat detail not found.';
	  $msg[625] = 'It seems your boat information is not complete. Please go to the boat Info section and fill all the details before proceeding. If the problem persists please contact xtract Admin.';
	  $msg[626] = 'Sorry, it seems you have been removed from this project so the details are not available anymore.';
	  $msg[627] = 'Project declined successfully.';

	  
	  $msg[628] = 'Sorry, you need to enter your company`s bank information in order to receive payouts. Do you wish to add that now?';
	  $msg[629] = 'Sorry, you need to enter your company`s identity information and bank details in order to receive payments. Do you wish to add that now?';
	  $msg[630] = 'Doctor yet not added.';
	  $msg[631] = 'profile not found.';
	  $msg[632] = 'Problem occurred in update profile.';
	  $msg[633] = 'Error in uploaded_file.';
	  $msg[634] = 'Patient yet not added.';
 	  $msg[635] = 'Patient List.';	
 	  $msg[636] = 'Congratulations! Your account has been created.'; 		
 	  $msg[637] = 'Problem occurred while creating your account'; 		
 	  $msg[638] = 'The email and code you entered is incorrect.  Please check your email and code and try again.'; 		
 	  $msg[639] = 'Successfully reset your password.'; 		
 	  $msg[640] = 'Old password you enter is incorrect.please check and try again.'; 		
	  $msg[641] = 'User Detail Fatch Succesfull';
	  $msg[642] = 'Error in Fatching Details';
	  $msg[643] = 'Fatched Detail';
	  $msg[644] = 'FAQ Fatched Detail';
	  $msg[645] = 'Your Query Sent Successfull';
	  $msg[646] = 'Not Sent';
	  $msg[647] = 'Profile Image Updated Successfully';
	  $msg[648] = 'Problem occurred in Update Profile Image.';
      $msg[649] = 'Image Updated Successfully';
	  $msg[649] = 'Notification Fatched Detail';
      $msg[650] = 'Details Fatch Successfull';
      $msg[651] = 'Post Upload Successfull';
	  $msg[652] = 'Upload Failed';
      $msg[653] = 'Visiting Card Image Updated Successfully';
      $msg[654] = 'Problem occurred in Update Visiting Card Image.';
      $msg[655] = 'Following';
	  $msg[656] = 'UnFollowing';
	  $msg[657] = 'Already Following';
	  $msg[658] = 'Block';
	  
	  
	  $msg[659] = 'Rejected';
	  $msg[660] = 'Request Send Successfully';
	  $msg[661] = 'Token saved successfully';
	  $msg[674] = 'Account deleted successfully';
	  $msg[675] = 'Password and Repassword does`t match.';
	  $msg[676] = 'UnBlock';
	  $msg[677]	= 'Message Send Successflly';
	  $msg[678] = 'Your Account is Private!!!';
	  $msg[679] = 'Your Account is not Private!!!';
	  $msg[680] = 'Your Account is Public!!!';
	  $msg[681] = 'Your Account is not Public!!!';
	  $msg[682] = 'Congratulations! Your Store has been created.';
	  $msg[683] = 'Problem occurred while creating your Store';  
	  $msg[684] = 'Comment Successfull'; 
	  $msg[685] = 'Requested'; 
	  $msg[686] = 'Already Requested';
	  $msg[687] = 'Save Post Successfull ';
	  $msg[688] = 'Review add Successfull ';
	  $msg[689] = 'Cart add Successfull';
	  $msg[690] = 'Cart deleted successfully';
	  $msg[691] = 'Like Successfully';
	  $msg[693] = 'Post favorite Successfully';
	  $msg[694] = 'Problem occurred favorite_post';
	  $msg[695] = 'You Already favorite Post';
	  $msg[696] = 'Do Not Disturb';
	  $msg[697]	= 'Un_save Post';
	  $msg[698]	= 'Problem occurred Un_save Post';
	  $msg[699]	= 'following';
	  $msg[700] = 'Already Requested';
	  $msg[701] = 'Artist favorite Successfully';
	  $msg[702] = 'Problem occurred favorite_artist';
	  $msg[703] = 'Post Share Successfully';
	  $msg[704] = 'Problem occurred Post Sharing';
	  $msg[705] = 'Share List Successfully fetched';
	  $msg[706] = 'Post Inapropriate reported successfully';
	  $msg[707] = 'Problem occurred when report post appropriate';
	  $msg[708] = 'Artist Found';
	  $msg[709] = 'Artist not found';
	  $msg[709] = 'Tag Updated';
	  $msg[710] = 'Visit now successfull';
	  $msg[711] = 'Visit now unsuccessfull';
	  $msg[712] = 'Order Details Get Successfully';
	  $msg[713] = 'Order Details Not Found';
	  $msg[714] = 'Tag Updated';
	  $msg[715] = 'Tag Not Updated';
	  $msg[716] = 'Order Cancelled';

	    if( isset($msg[$msgId]) ){
	        $message = $msg[$msgId];
	    }else{
	        $message = '';
	    }
	    return $message;
	}


}