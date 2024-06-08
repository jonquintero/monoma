<?php

namespace Modules\UserAndLead\Http\Controllers;

use App\Facades\ApiResponseFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Modules\UserAndLead\Actions\UserAndLeadAction;
use Modules\UserAndLead\Actions\UserAndLeadListAction;
use Modules\UserAndLead\Actions\UserAndLeadShowAction;
use Modules\UserAndLead\DataTransferObjects\UserAndLeadData;
use Modules\UserAndLead\Http\Requests\UserAndLeadRequest;
use Modules\UserAndLead\Http\Resources\UserAndLeadResource;
use Modules\UserAndLead\Models\Lead;
use Symfony\Component\HttpFoundation\Response;

class LeadController extends Controller
{
    public function __construct(private readonly UserAndLeadAction $userAndLeadAction,
        private readonly UserAndLeadShowAction $userAndLeadShowAction,
        private readonly UserAndLeadListAction $userAndLeadListAction)
    {
    }

    public function index()
    {
        return $this->userAndLeadListAction->execute();
    }

    /**
     * @param UserAndLeadRequest $request
     * @return mixed
     */
    public function store(UserAndLeadRequest $request): mixed
    {
        if ($request->user()->cannot('create', Lead::class)) {
            return ApiResponseFacade::error('Token expired', Response::HTTP_UNAUTHORIZED);
        }
       return ApiResponseFacade::ok([UserAndLeadResource::make($this->upsert($request, new Lead()))], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return $this->userAndLeadShowAction
            ->execute($id);
    }



    public function upsert(UserAndLeadRequest $request, Lead $lead): Lead
    {
        $userAndLeadData = new UserAndLeadData(...$request->validated());

        return $this->userAndLeadAction->execute($userAndLeadData, $lead);
    }
}
