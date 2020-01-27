<?php

// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
// Specify your authentication credentials
// Get settings
$username= "ronniewise";
$apikey ="300624b0133c7be03c177c28aebd93fb154618e47211c54b4ab500f722f7414d";
$recipients = "+254705527213";
// And of course we want our recipients to know what we really do
$message    = "Hello, You have defaulted on the expected return date for a book you borroewd therefore Your libray fine of Ksh () is expected by the end of the week";
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
/*************************************************************************************
  NOTE: If connecting to the sandbox:
  1. Use "sandbox" as the username
  2. Use the apiKey generated from your sandbox application
     https://account.africastalking.com/apps/sandbox/settings/key
  3. Add the "sandbox" flag to the constructor
  $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
  header("Refresh:0; url=manage-issued-books.php");
  
  
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
?>
<?php

echo '<script type="text/javascript">

          window.onload = function () { alert("The message has been sent to user"); }

</script>';

?>
 