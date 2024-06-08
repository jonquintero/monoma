<?php

namespace Modules\UserAndLead\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\UserAndLead\DataTransferObjects\UserAndLeadData;
use Modules\UserAndLead\Models\Lead;

class UserAndLeadAction
{
     public function execute(UserAndLeadData $userAndLeadData, Lead $lead): Lead
        {
           $lead->name = $userAndLeadData->name;
           $lead->source = $userAndLeadData->source;
           $lead->owner = $userAndLeadData->owner;
           $lead->created_by = Auth::id();
           $lead->save();


           Cache::put('lead_' . $lead->id, $lead, now()->addHours(24));

           return $lead;
        }
}
