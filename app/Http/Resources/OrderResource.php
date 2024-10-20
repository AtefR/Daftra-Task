<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total' => $this->total,

            'user_id' => $this->user_id,

            'products' => OrderProductResource::collection($this->whenLoaded('products')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}