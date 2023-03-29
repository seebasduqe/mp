<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * Open SSL crypt implementation
 * @filename: open_ssl_crypt.class.php
 * Location: _app/_models/_class
 * @Creator: J. Raya (JRM) <info@novaigrup.com>
 * 	20150511 JRM Created
 * 	20151005 JRM Updated
 */
class OpenSslCrypt extends Model
{

    /**
     * @var string public ssl key filename path
     * @access private
     */
    private $public_key = '';

    /**
     * @var string private ssl key filename path
     * @access private
     */
    private $private_key = '';

    /**
     * @var string password
     * @access private
     */
    private $password = '';

    /**
     * Class constructor
     * @param string $public_key
     * @param string $private_key
     * @param string $password	
     * @access public
     */
    public function __construct($public_key, $private_key, $password)
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
        $this->password = $password;
    }

    /**
     * Encrypt string with the public ssl key
     * @param string $string
     * @return string base64 encrypted string
     * @access public
     */
    function encrypt($string)
    {

        openssl_get_publickey($this->public_key);

        openssl_public_encrypt($string, $encrypted_string, $this->public_key);
        return (base64_encode($encrypted_string));
    }

    /**
     * Decrypt string with the private ssl key
     * @param string $string
     * @return string
     * @access public
     */
    function decrypt($string)
    {
        $result = openssl_get_privatekey($this->private_key, $this->password);
        $string = base64_decode($string);
        openssl_private_decrypt($string, $decrypt_string, $result);
        return $decrypt_string;
    }
}
