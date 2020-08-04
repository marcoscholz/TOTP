<?php
class TOTP{
    protected string $key;
    protected int $t0 = 0;
    protected int $tx = 30;
    protected int $n = 6;
    protected string $algo = "sha1";

    public function __construct(string $key, ?int $t0=null, ?int $tx=null, ?int $n=null, ?string $algo=null){
        $this->key  = $key;
        $this->t0   = $t0   ?? $this->t0;
        $this->tx   = $tx   ?? $this->tx;
        $this->n    = $n    ?? $this->n;
        $this->algo = $algo ?? $this->algo;
    }

    public function getToken(?int $t=null) : int {
        // Set t to current timestamp if it wasn't ste
        $t = $t ?? time();
        print "\nt=$t\n";

        // Calculate the current counter
        $c = intdiv($t - $this->t0, $this->tx);

        // Calculate the binary hash
        $hash = hash_hmac($this->algo, $c, base32_encode($this->key), false);

        // transform the hash into an integer
        $hash_integer = hexdec($hash);#hexdec($hash_hex);

        // get the n digits log token by using modulo 10^n
        $token = $hash_integer % pow(10,$this->n);

        return $token;
    }

    // Alias methods to get next and previous token
    public function getNextToken() : string { return $this->getToken(time()+$this->n); }
    public function getPrevToken() : string { return $this->getToken(time()+$this->n); }

    // Static method to generate a new Base32 key
    public static function generateKey(int $length=32) : string {
        // array with the base32 alphabet
        $alphabet=str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ234567");

        $key="";
        // keep adding random characters until length is reached
        while(strlen($key)<$length) $key.= $alphabet[random_int(0,count($alphabet)-1)];

        return $key;
    }
}
