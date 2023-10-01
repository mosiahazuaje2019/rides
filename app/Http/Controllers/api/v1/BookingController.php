<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Http\JsonResponse;

function isAnAirport($param) {
    $lines = array(
        "Los Cabos International Airport (SJD), Carretera Transpeninsular, San José del Cabo, BCS, Mexico",
        "San José del Cabo, Baja California Sur, México",
        "Aeropuerto Internacional de Los Cabos (SJD), Carretera Transpeninsular, San José del Cabo, Baja California Sur, México",
        "Los Cabos International Airport (SJD), Carretera Transpeninsular, San José del Cabo, Baja California Sur, México",
        "Aeropuerto Internacional de Cabo San Lucas, Avenida Leona Vicario, Mesa Colorada, Cabo San Lucas, Baja California Sur, México",
        "San Jose del Cabo Airport, Baja California Sur, México",
        "Los Cabos Internationale Lufthavn (SJD), Carretera Transpeninsular, San José del Cabo, BCS, Mexico",
        "San José del Cabo, BCS, Mexico",
        "San Jose del Cabo Airport, 23429 B.C.S., Mexico",
        "Los Cabos International Airport Road, El Salto, BCS, Mexico",
        "Alaska Airlines - Los Cabos, Cabo San Lucas, BCS, Mexico",
        "Cabo San Lucas, BCS, Mexico",
        "Aeropuerto Internacional de Los Cabos (SJD), Carretera Transpeninsular, San José del Cabo, B.C.S., México",
        "Aeropuerto Internacional de Los Cabos (SJD), Carr. Transpeninsular Km 43.5, 23420 San José del Cabo, B.C.S., México",
        "Los Cabos International Airport (SJD) (SJD), Carretera Transpeninsular, San José del Cabo, BCS, Mexico"
    );

    foreach ($lines as $line) {
        if ($line === $param) {
            return true;
        }
    }

    return false;
}

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
                $this->booking->orderBy('time','asc')->get()
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
        if($request->date) {
            $bookingData['date'] = Carbon::parse($request->date)->format('Y-m-d');
        }

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

    public function filterByDate(BookingStoreRequest $request): JsonResponse
    {
        $date = $request->input('date');

        return response()->json(
            new BookingCollection(
                $this->booking
                        ->where('date', Carbon::parse($date)->format('Y-m-d'))
                        ->orderBy('time','asc')->get()
            )
        );
    }

    public function filterContains(BookingStoreRequest $request): JsonResponse
    {
        $contains = $request->input('contains');

        return response()->json(
            new BookingCollection(
                $this->booking
                ->where(function ($query) use ($contains) {
                    $query->where('client_name', 'like', "%{$contains}%")
                          ->orWhere('request_id', 'like', "%{$contains}%");
                })
                ->orderBy('time', 'asc')
                ->get()
            )
        );
    }

    public function cabosrwh(Request $request):JsonResponse
    {
        $requestId = $request->input('post')['ID'];
        $pax = $request->input('meta')['passenger_adult_number'] . "." . $request->input('meta')['passenger_children_number'];

        $serviceType = $request->input('transfer_type_name');
        $clientName = $request->input('meta')['client_contact_detail_first_name'] . " " . $request->input('meta')['client_contact_detail_last_name'];

        $arrival_flight = $request->input('meta')['form_element_field'][0]['value'] . "#" . $request->input('meta')['form_element_field'][1]['value'];
        $departure_flight = $request->input('meta')['form_element_field'][2]['value'] . "#" . $request->input('meta')['form_element_field'][3]['value'];

        $pickup_date = $request->input('meta')['pickup_date'];
        $pickup_time = $request->input('meta')['pickup_time'];
        $extras = $request->input('meta')['comment'];

        if ($serviceType === "One Way") {
            if (isAnAirport($request->input('meta')['coordinate'][0]['address']) == true) {
                $service = "LLegada";
                $hotel = $request->input('meta')['coordinate'][1]['address'];

                $booking = new Booking;
                $booking->request_id = $requestId;
                $booking->pax = $pax;
                $booking->service = $service;
                $booking->client_name = $clientName;
                $booking->hotel = $hotel;
                $booking->flight = $arrival_flight;
                $booking->date = Carbon::parse($pickup_date)->format('Y-m-d');
                $booking->time = $pickup_time;
                $booking->extras = $extras;
                $booking->save();
            } else {
                $service = "Salida";
                $hotel = $request->input('meta')['coordinate'][0]['address'];

                $booking = new Booking;
                $booking->request_id = $requestId;
                $booking->pax = $pax;
                $booking->service = $service;
                $booking->client_name = $clientName;
                $booking->hotel = $hotel;
                $booking->flight = $departure_flight;
                $booking->date = Carbon::parse($pickup_date)->format('Y-m-d');
                $booking->time = $pickup_time;
                $booking->save();
            }
        } else if ($serviceType === "Round Trip") {
            $service = "LLegada";
            $hotel = $request->input('meta')['coordinate'][1]['address'];

            $booking = new Booking;
            $booking->request_id = $requestId;
            $booking->pax = $pax;
            $booking->service = $service;
            $booking->client_name = $clientName;
            $booking->hotel = $hotel;
            $booking->flight = $arrival_flight;
            $booking->date = Carbon::parse($pickup_date)->format('Y-m-d');
            $booking->time = $pickup_time;
            $booking->save();


            $service = "Salida";
            $return_date = $request->input('meta')['return_date'];
            $return_time = $request->input('meta')['return_time'];

            $booking = new Booking;
            $booking->request_id = $requestId;
            $booking->pax = $pax;
            $booking->service = $service;
            $booking->client_name = $clientName;
            $booking->hotel = $hotel;
            $booking->flight = $departure_flight;
            $booking->date = Carbon::parse($return_date)->format('Y-m-d');
            $booking->time = $return_time;
            $booking->save();
        }

        return response()->json();
    }

    public function filterByCriteria(Request $request) {

        $rides = Booking::orderBy('id','desc')
            ->drivers($request->driver)
            ->rideDates($request->dateini,$request->dateend)
            ->get();

        return response()->json(
            new BookingCollection($rides)
        );
    }

    public function filterByDriver(Request $request){
        $rides = Booking::orderBy('id','desc')
            ->drivers($request->driver)
            ->get();
    }

    public function generatePDF(Request $request)
    {
        $bookings = Booking::
        with(['driver'])
        ->rideDates($request->date,$request->date)
        ->get();

        $data = [
            'title' => 'Operaciones de servicios',
            'dateSelected' => $request->date,$request->date,
            'bookings' => $bookings
        ];

        $pdf = PDF::loadView('booking_report', $data)->setPaper('a4', 'landscape');

        return $pdf->download('booking_report.pdf');
    }
}
