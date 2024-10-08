<?php

namespace Inilim\PseudoUUID;

final class UUID
{
   function v7FromTimestamp(int $time): string
   {
      return \dechex($time) . '-' . $this->after($this->v4(), '-');
   }

   function toByte(string $uuid): string
   {
      return \pack('H*', \str_replace('-', '', $uuid));
   }

   function v7(): string
   {
      return $this->v7FromTimestamp(\time());
   }

   function v4(): string
   {
      $s = \bin2hex(\random_bytes(16));

      return \substr($s, 0, 8)
         . '-'
         . \substr($s, 8, 4)
         . '-'
         . \substr($s, 12, 4)
         . '-'
         . \substr($s, 16, 4)
         . '-'
         . \substr($s, 20, 12);
   }

   /**
    * Return the remainder of a string after the first occurrence of a given value.
    */
   protected function after(string $subject, string $search): string
   {
      return $search === '' ? $subject : \array_reverse(\explode($search, $subject, 2))[0];
   }
}
