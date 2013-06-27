Deep Thought
============

Deep Thought API

This is a PHP Bridge module, allowing simple access to the Probability Deep Thought API.

You will need an API Key to use the service, this can be obtained from your account manager.

Example usage:

    <?php
    $dtConfig = array("apiKey" => [MY API KEY]);
    $dt = new DeepThought($dtConfig);
    
    $params = array();
    $params["firstName"] = "Joe";
    $params["lastName"] = "Bloggs";
    $params["dob"] = "01011970";
    ...
    
    try {
        $resp = $dt->user_create();
    } catch(Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
    if (!$resp["response"] != "SUCCESS") {
        echo "Uh-oh, something went wrong.\n";
    }
    
    $user_id = $resp["parameters"]["user_id"];
    $token = $resp["parameters"]["token"];
    
    ?>
