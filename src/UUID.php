<?php

namespace Inilim\PseudoUUID;

class UUID
{
   function v7(): string
   {
      return \dechex(\time()) . '-' . \_str()->after($this->v4(), '-');
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
}
