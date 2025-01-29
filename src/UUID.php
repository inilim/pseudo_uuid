<?php

namespace Inilim\PseudoUUID;

final class UUID
{
   /**
    * @return string
    */
   function toByte(string $uuid)
   {
      return \pack('H*', \str_replace('-', '', $uuid));
   }

   /**
    * @return string
    */
   function v7()
   {
      $unixMs = \intval(\microtime(true) * 1000);
      $s = \random_bytes(10);
      $s[0] = \chr((\ord($s[0]) & 0x0f) | 0x70); // set version
      $s[2] = \chr((\ord($s[2]) & 0x3f) | 0x80); // set variant
      return \vsprintf(
         '%s%s-%s-%s-%s-%s%s%s',
         \str_split(
            \str_pad(\dechex($unixMs), 12, '0', \STR_PAD_LEFT) .
               \bin2hex($s),
            4
         )
      );
   }

   /**
    * @return string
    */
   function v4()
   {
      $s = \random_bytes(16);
      $s[6] = \chr(\ord($s[6]) & 0x0f | 0x40); // set version to 0100
      $s[8] = \chr(\ord($s[8]) & 0x3f | 0x80); // set bits 6-7 to 10
      return \vsprintf('%s%s-%s-%s-%s-%s%s%s', \str_split(\bin2hex($s), 4));
   }
}
