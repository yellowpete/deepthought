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
    $params->firstName = "Joe";
    $params->lastName = "Bloggs";
    $params->dob = "01011970";
    ...
    
    try {
        $dt->user_create();
    } catch(Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    ?>
