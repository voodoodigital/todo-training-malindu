<?php
// do your testing here


// require("inputValidator.php");

// $inputsObject = new stdClass();
// $inputsObject->username = 'trackey';
// $inputsObject->firstname = 'janith';
// $inputsObject->lastname = 'nirmal';
// $inputsObject->nukaaa = 'buddika';
// $inputsObject->asda = 'buddika';
// $inputsObject->nukaaasdasa = 'buddika';
// $inputsObject->nukaaaasda = '213ddika';
// $inputsObject->email = 'email@email.com';
// $inputsObject->slmobile = '0710902998';

// $validator = new Validator($inputsObject);

// $validation = $validator->validator();
// echo (var_dump($validation));

// Original string with special characters




// require("inputSenitisor.php");
// $senitisor = new Senitisor();
// echo ($senitisor->sanitizeInput('<script>alert("test");</script>'));
// echo ('<script>alert("test");</script>');




// class StrongPasswordEncryptor
// {

//     // Encryption method 1
//     private static function encryptMethod1($password)
//     {
//         return hash('sha512', $password);
//     }

//     // Encryption method 2
//     private static function encryptMethod2($password)
//     {
//         return hash('sha256', $password);
//     }

//     // Encryption method 3
//     private static function encryptMethod3($password)
//     {
//         $salt1 = uniqid(mt_rand(), true);
//         return hash('sha512', $password . $salt1);
//     }

//     // Encryption method 4
//     private static function encryptMethod4($password)
//     {

//         $salt2 = openssl_random_pseudo_bytes(16);
//         $key = hash_pbkdf2("sha512", $password, $salt2, 10000, 64);
//         return base64_encode($salt2 . $key);
//     }


//     // Public method to encrypt password using all methods
//     public static function encryptPassword($password)
//     {
//         $encrypted_password = self::encryptMethod1($password);
//         $encrypted_password .= self::encryptMethod2($password);
//         // $encrypted_password .= self::encryptMethod3($password);
//         // $encrypted_password .= self::encryptMethod4($password);
//         return $encrypted_password;
//     }
// }

// // Usage example:
// $password = 'janithnirmal';
// $encrypted_password = StrongPasswordEncryptor::encryptPassword($password);
// echo $encrypted_password;























// // db test
// require("dbQuery.php");

// $database = new DB('localhost', 'root', 'JanithNirmal12#$', 'test_db');

// $query = "SELECT * FROM `test_db`.`test`";
// // $preparedStatement = $database->prepare($query, 'si', ['janith', '20']);
// // $preparedStatement = $database->query($query);

// $results = $preparedStatement;
// // echo ($results->field_count);





require("dbQuery.php");
$database = new DB('localhost', 'root', 'JanithNirmal12#$', 'test_db');
for ($y = 0; $y < 1; $y++) {
    // db test


    $query = "SELECT * FROM `test` WHERE `age`=? ";
    $preparedStatement = $database->prepare($query, 'i', ['20']);
    $result = $preparedStatement->get_result();

    $resultCount = $result->num_rows;

    for ($x = 0; $x < $resultCount; $x++) {
        $row = $result->fetch_assoc();
        echo $row['name'] . ' ' . $row['age'] . "<br>";
    }
}



// // Fetch the rows from the result object
// while ($row = $result->fetch_assoc()) {
//     // Do something with the row data
//     echo $row['name'] . ' ' . $row['age'] . "<br>";
// }
