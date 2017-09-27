<?php

// You will need to install the AWS SDK through composer
// get composer: https://getcomposer.org/doc/00-intro.md
// install aws sdk by adding it to your composer file - see composer.json - and running ./composer.phar install

require_once 'vendor/autoload.php';
use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;


//alternatively to installing the SDK, you can get hold of the aws.phar file which you can include instead of the 3 lines above.
//download it here: https://github.com/aws/aws-sdk-php/releases
//to use, uncomment the line below and comment out the 3 above this block
//include('aws.phar');


//error_reporting(E_ALL);
//ini_set('display_errors', 1);


//aws keys - need to be created in IAM console and need to have SES sending access
define('KEY','YOU_AWS_KEY');
define('SECRET','YOUR_AWS_SECRET');

//replace with the region you're using if different to us-east-1. Find it by clicking on the sending address in the SES console. It is part of the Identity ARN.
define('REGION','us-east-1'); 
define('CHARSET','UTF-8');



//call this function to send

function sendEmail($sender, $recipient, $subject, $textbody, $htmlbody)

{

	$client = SesClient::factory(array(
	    'version'=> 'latest',     
	    'region' => REGION,
	    'key' => KEY,
	    'secret' => SECRET
	));


	try {
	     $result = $client->sendEmail([
	    'Destination' => [
	        'ToAddresses' => [
	            $recipient,
	        ],
	    ],
	    'Message' => [
	        'Body' => [
	            'Html' => [
	                'Charset' => CHARSET,
	                'Data' => $htmlbody,
	            ],
				'Text' => [
	                'Charset' => CHARSET,
	                'Data' => $textbody,
	            ],
	        ],
	        'Subject' => [
	            'Charset' => CHARSET,
	            'Data' => $subject,
	        ],
	    ],
	    'Source' => $sender,
	    // Comment or remove the following line if you are not using a configuration set
	    //'ConfigurationSetName' => CONFIGSET,
	]);
	     $messageId = $result->get('MessageId');
	     echo("Email sent! Message ID: $messageId"."\n");

	} catch (SesException $error) {
	     echo("The email was not sent. Error message: ".$error."\n");
	}


}


//that's it.


?>

