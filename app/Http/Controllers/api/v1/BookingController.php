<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    protected $booking;

    public function __construct(Booking $booking) {
        $this->booking = $booking;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            new BookingCollection(
                $this->booking
                        ->where('date', Carbon::now()->format('Y-m-d'))
                        ->orderBy('time','asc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request): JsonResponse
    {
        $bookingData = $request->all();
        $bookingData['date'] = Carbon::parse($request->date)->format('Y-m-d');
        $bookingData['time'] = Carbon::parse($request->time)->format('H:i:s');

        $booking = $this->booking->create($bookingData);
        return response()->json(new BookingResource($booking), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): JsonResponse
    {
        return response()->json(
            new BookingResource($booking)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingUpdateRequest $request, Booking $booking): JsonResponse
    {
        $bookingData = $request->all();
        $bookingData['date'] = Carbon::parse($request->date)->format('Y-m-d');
        $bookingData['time'] = Carbon::parse($request->time)->format('H:i:s');

        $booking->update($bookingData);
        return response()->json(new BookingResource($booking));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();
        return response()->json(null,204);
    }
}
