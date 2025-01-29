<?php

namespace Inilim\PseudoUUID;

final class UUID
{
   const UUID_REGEX = '/^(?:urn:)?(?:uuid:)?(\{)?([0-9a-f]{8})\-?([0-9a-f]{4})'
      . '\-?([0-9a-f]{4})\-?([0-9a-f]{4})\-?([0-9a-f]{12})(?(1)\}|)$/i';

   /**
    * @return string
    */
   function getBytes(string $uuid)
   {
      return \pack('H*', $this->stripExtras($uuid));
   }

   /**
    * @return string
    */
   function v7()
   {
      $uhex  = \substr(\str_pad(\dechex($this->getUnixTimeMs()), 12, '0', \STR_PAD_LEFT), -12);
      $uhex .= \bin2hex(\random_bytes(10));
      return $this->uuidFromHex($uhex, 7);
   }

   /**
    * @return string
    */
   function v4()
   {
      return $this->uuidFromHex(
         \bin2hex(\random_bytes(16)),
         4
      );
   }

   /**
    * @return int
    */
   protected function getUnixTimeMs()
   {
      $timestamp = \microtime(false);
      return \intval(\substr($timestamp, 11), 10) * 1000 + \intval(\substr($timestamp, 2, 3), 10);
   }

   /**
    * @return string
    */
   protected function uuidFromHex(string $uhex, int $version): string
   {
      return \sprintf(
         '%08s-%04s-%04x-%04x-%12s',
         \substr($uhex, 0, 8),
         \substr($uhex, 8, 4),
         (\hexdec(\substr($uhex, 12, 4)) & 0x0fff) | $version << 12,
         (\hexdec(\substr($uhex, 16, 4)) & 0x3fff) | 0x8000,
         \substr($uhex, 20, 12)
      );
   }

   /**
    * @return string
    */
   protected function stripExtras(string $uuid)
   {
      if (\preg_match(self::UUID_REGEX, $uuid, $m) !== 1) {
         throw new \InvalidArgumentException('Invalid UUID string: ' . $uuid);
      }
      return \strtolower($m[2] . $m[3] . $m[4] . $m[5] . $m[6]);
   }
}
