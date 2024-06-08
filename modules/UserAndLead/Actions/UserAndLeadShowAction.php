<?php

namespace Modules\UserAndLead\Actions;

use App\Facades\ApiResponseFacade;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Modules\UserAndLead\Http\Resources\UserAndLeadResource;
use Modules\UserAndLead\Models\Lead;
use Symfony\Component\HttpFoundation\Response;

class UserAndLeadShowAction
{
    public function execute($id)
    {
        $lead = Cache::get('lead_' . $id);

        if (!$lead) {
            try {
                $lead = Lead::findOrFail($id);
                Cache::put('lead_' . $lead->id, $lead, now()->addHours(24));

            } catch (ModelNotFoundException $e) {
                return ApiResponseFacade::error('No lead found', Response::HTTP_NOT_FOUND);
            }
        }

        if (Gate::denies('view', $lead)) {
            return ApiResponseFacade::error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return ApiResponseFacade::ok([UserAndLeadResource::make($lead)], Response::HTTP_OK);
    }



}
