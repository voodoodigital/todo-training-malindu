<?php



class StrongPasswordEncryptor
{

    // Encryption method 3
    private static function encryptMethod3($password)
    {
        $salt = uniqid(mt_rand(), true);
        $hash =  hash('sha512', $password . $salt);
        return array("hash" => $hash, "salt" => $salt);
    }

    // Public method to encrypt password using all methods
    public static function encryptPassword($password)
    {
        $encrypted_password = self::encryptMethod3($password);
        return $encrypted_password;
    }
}



class PasswordHashVerifier
{
    // verifier
    public static function isValid($password, $salt, $hash)
    {
        $generatedhash =  hash('sha512', $password . $salt);
        if ($generatedhash == $hash) {
            return 1;
        } else {
            return 0;
        }
    }
}
