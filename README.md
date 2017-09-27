# AWS-SES-Send-Email-PHP
A nice simple function to send emails with Amazon's SES service using PHP


# Setup

Verify an email address or domain in the SES console - it won't work without this.

Put in a service request for however many emails a day you want to be able to send, cross hyour fingers.
(Until you do this, you can only send to email addresses and domains you have validated so you can still test)

Add your AWS Key and Secret to send_email.inc.php

You will need to install the AWS SDK through composer
To get composer: https://getcomposer.org/doc/00-intro.md
Install aws sdk by adding it to your composer file - see composer.json - and running ./composer.phar install


Alternatively to installing the SDK, you can get hold of the aws.phar file which you can include instead of the 3 lines above.
Download it here: https://github.com/aws/aws-sdk-php/releases

See comments in file for instructions.

# Usage

include('send_email.inc.php');

sendEmail('bob@your_verified_ses_email.com, 'someone@some_other_address.com, 'hi!', 'This is an email', '<strong>This</strong> is an email');
