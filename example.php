<?php

require_once "TOTP.class.php";

$key = TOTP::generateKey();
print "generate new key: $key";

$Generator = new TOTP($key);

for($i=0; $i<1; $i++){
    $token=$Generator->getToken();
    print "$token\n";
}