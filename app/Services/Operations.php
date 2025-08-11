<?php 

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations
{
    public static function decryptId($value)
    {
        // This method is for testing decryption
        try {
            $decryptedId = Crypt::decrypt($value);
            echo 'Decrypted ID: ' . $decryptedId;   

    } catch (DecryptException $e) {
            echo 'Decryption failed: ' . $e->getMessage();
            return null;
        }   
        return $decryptedId ?? null;
    }

}