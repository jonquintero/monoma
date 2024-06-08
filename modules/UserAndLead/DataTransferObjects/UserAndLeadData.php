<?php

namespace Modules\UserAndLead\DataTransferObjects;

readonly class UserAndLeadData
{
    public function __construct(
           public string $name,
           public string $source,
           public int $owner
    )
   {

   }
}
