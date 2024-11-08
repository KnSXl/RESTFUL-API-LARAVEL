<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cd_user' => $this->cd_user,
            'ds_name' => $this->ds_name,
            'ds_email' => $this->ds_email,
            'dt_created' => $this->dt_created,
            'dt_updated' => $this->dt_updated,
        ];
    }
}
