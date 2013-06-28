Deep Thought
============

Deep Thought API

This is a PHP Bridge module, allowing simple access to the Probability Deep Thought API.

You will need an API Key to use the service, this can be obtained from your account manager.

Example usage:

    <?php
    include_once("DeepThought.php");
    $dtConfig = array("apiKey" => [MY API KEY]);
    $dt = new DeepThought($dtConfig);
    
    // For testing only
    //$dt->api_url = "https://deepthought.staging.probability.co.uk:1456/";
    
    $params = array();
    $params["firstName"] = "Joe";
    $params["lastName"] = "Bloggs";
    $params["dob"] = "01011970";
    ...
    
    try {
        $resp = $dt->user_create();
    } catch(Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        exit;
    }
    
    if ($resp["response"] != "SUCCESS") {
        echo "Uh-oh, something went wrong.\n";
        exit;
    }
    
    $user_id = $resp["parameters"]["userId"];
    $token = $resp["parameters"]["pushToken"];
    
    ?>
