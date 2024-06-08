<?php
namespace Modules\UserAndLead\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\UserAndLead\Models\Lead;

/** @mixin Lead */
class UserAndLeadResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'source' => $this->source,
            'owner' => $this->owner,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ];
    }
}
