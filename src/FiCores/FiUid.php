<?php
namespace Engtuncay\Phputils8\FiCores;

/**
 * Generates unique identifiers (UUID, short UUID, CUID)
 */
class FiUid
{
  public static function genUid(): string
  {
    // UUID v4 oluşturmak için rastgele 16 byte'lık bir dizi oluşturun
    $data = random_bytes(16);

    // UUID v4 formatına uygun hale getirin
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // Versiyon 4
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // Variant

    // UUID'yi standart formatta döndürün
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  public static function genUidShort(): string
  {
    // UUID v4 oluşturmak için rastgele 16 byte'lık bir dizi oluşturun
    $data = random_bytes(16);

    // UUID v4 formatına uygun hale getirin
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // Versiyon 4
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // Variant

    // Kısa formatta döndürün (tireler olmadan)
    return bin2hex($data);
  }

  public static function genCuid(): string
  {
    // Daha uyumlu CUID algoritması
    static $counter = 0;
    $counter++;
    $counterStr = str_pad(dechex($counter), 4, '0', STR_PAD_LEFT);

    $timestamp = dechex((int)(microtime(true) * 1000)); // milisaniye, hex
    $random = bin2hex(random_bytes(4)); // 8 karakter
    $fingerprint = substr(md5(gethostname() . getmypid()), 0, 6); // sistem parmak izi

    // Sabit uzunluk için padding
    $timestamp = str_pad($timestamp, 12, '0', STR_PAD_LEFT);

    return 'c' . $timestamp . $counterStr . $random . $fingerprint;
  }

}