<?php

namespace Modules\UserAndLead\Actions;

use App\Facades\ApiResponseFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Modules\UserAndLead\Http\Resources\UserAndLeadResource;
use Modules\UserAndLead\Models\Lead;
use Symfony\Component\HttpFoundation\Response;

class UserAndLeadListAction
{
    /**
     * @return mixed
     */
    public function execute():mixed
    {
        $user = Auth::user();

        if (Gate::denies('viewAny', Lead::class)) {

            return ApiResponseFacade::error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        if ($user->role === 'manager') {

            $leads = Cache::remember('leads_manager', now()->addMinutes(60), function () {
                return Lead::all();
            });
        } else {
            $leads = Cache::remember('leads_agent_' . $user->id, now()->addMinutes(60), function () use ($user) {
                return Lead::where('owner', $user->id)->get();
            });
        }

        return ApiResponseFacade::ok([UserAndLeadResource::collection($leads)], Response::HTTP_OK);

    }
}
