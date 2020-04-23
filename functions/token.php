<?php
require_once('alert.php');
require_once('user.php');
//send the email and redirect the reset password
//TODO: work on token generation
//generating token manually
function generate_token()
{
    $token = "";
    $alphabets = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    for ($i = 0; $i < 26; $i++) {
        //get random numbers // get alphabet at index of random numbers
        $index = mt_rand(0, count($alphabets) - 1);
        $token .= $alphabets[$index];
    //token ends here
    }
    return $token;
}
function find_token($email){
    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);

    for ($counter = 0; $counter < $countAllUserTokens; $counter++) {

        $currentTokenFile = $allUserTokens[$counter];

        if ($currentTokenFile == $email . ".json") {
            //now check if the token in  the current token is the same with the one in our folder; 
            $tokenContent  =   file_get_contents("db/tokens/" . $currentTokenFile);
            $tokenObject = json_decode($tokenContent);

            return $tokenObject;
        }
    }
    return false;
}    
?>