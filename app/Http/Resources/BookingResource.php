<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'request_id' => $this->request_id,
            'driver_id' => $this->driver_id,
            'pax' => $this->pax,
            'service' => $this->service,
            'client_name' => $this->client_name,
            'hotel' => $this->hotel,
            'flight' => $this->flight,
            'date' => Carbon::parse($this->date)->format('d/m/y'),
            'time' => $this->time,
            'agency' => $this->agency,
            'status' => $this->status,
            'extras' => $this->extras
        ];
    }
}
