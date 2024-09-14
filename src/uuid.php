<?php

namespace info\synapp\tools\uuid;

use InvalidArgumentException;

/**
 * Class UUID
 *
 * @author Andrew Moore
 * @link http://www.php.net/manual/en/function.uniqid.php#94959
 *
 * It generates v3, v4, v5 UUIDs
 *
 * Usage:
 *
 * ```php
 *
 *   use info\synapp\tools\uuid\UUID;
 *   require_once 'path/to/uuid.php';
 *
 *   //Named-based UUID:
 *
 *   $v3uuid = UUID::v3(UUID::v4(), 'BlahBlahSomeRandomStringBlergBlorg');
 *   $v5uuid = UUID::v5(UUID::v4(), 'BlahBlahSomeRandomStringBlergBlorg');
 *
 *   //Pseudo-random UUID:
 *
 *   $v4uuid = UUID::v4();
 *
 *```
 *
 */
class UUID
{
    /**
     * @param string $namespace (in UUID format)
     * @param string $name
     * @return string the V3 UUID
     */
    public static function v3($namespace, $name)
    {
        if (!self::isValid($namespace)) {
            throw new InvalidArgumentException("Invalid namespace");
        }
        $namespaceHexString = self::getNamespaceHexString($namespace);

        // Calculate hash value
        $hash = md5($namespaceHexString . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',

            // 32 bits for "time_low"
            substr($hash, 0, 8),

            // 16 bits for "time_mid"
            substr($hash, 8, 4),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 3
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

            // 48 bits for "node"
            substr($hash, 20, 12)
        );
    }

    /**
     * @return string the random V4 UUID
     */
    public static function v4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * @param string $namespace (in UUID format)
     * @param string $name
     * @return string the V5 UUID
     */
    public static function v5($namespace, $name)
    {
        if (!self::isValid($namespace)) {
            throw new InvalidArgumentException("Invalid namespace");
        }

        // Get hexadecimal components of namespace
        $namespaceHexString = self::getNamespaceHexString($namespace);

        // Calculate hash value
        $hash = sha1($namespaceHexString . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',

            // 32 bits for "time_low"
            substr($hash, 0, 8),

            // 16 bits for "time_mid"
            substr($hash, 8, 4),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 5
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

            // 48 bits for "node"
            substr($hash, 20, 12)
        );
    }

    /**
     * @param string $uuid
     * @return bool true if valid UUID string; false otherwise
     */
    public static function isValid($uuid)
    {
        return preg_match('/^\{?[0-9a-f]{8}-?[0-9a-f]{4}-?[0-9a-f]{4}-?' .
                '[0-9a-f]{4}-?[0-9a-f]{12}}?$/i', $uuid) === 1;
    }

    protected static function getNamespaceHexString($namespace)
    {
        // Get hexadecimal components of namespace
        $namespaceHexArray = str_replace(array('-', '{', '}'), '', $namespace);

        // Binary Value
        $namespaceHexString = '';

        // Convert Namespace UUID to bits
        for ($i = 0; $i < strlen($namespaceHexArray); $i += 2) {
            $namespaceHexString .= chr(hexdec($namespaceHexArray[$i] . $namespaceHexArray[$i + 1]));
        }
        return $namespaceHexString;
    }
}
