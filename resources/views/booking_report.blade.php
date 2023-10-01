<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Reporte de ordenes</title>
</head>
<body>
    <table style="width:100%">
        <thead>
            <tr>
                <th class="text-left">
                    <img src="{{ public_path('images/cabosr-logo.png')}}" alt="logo" width="280px">
                </th>
                <th class="text-left">
                    <h3>{{ $title }}</h3>
                    <h3>{{ $dateSelected }}</h3>
                </th>
                <th class="text-center">
                    <img src="{{ public_path('images/logo_report.jpg')}}" alt="logo" width="180px">
                </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table style="width:100%; table-layout:fixed; font-size:10px" class="table table-sm table-striped">
        <thead>
        </thead>
        <tbody>
            <tr>
                <th>Request</th>
                <th>Driver</th>
                <th>Pax</th>
                <th>Service</th>
                <th>Cliente</th>
                <th style="width:20%">Hotel</th>
                <th>Flight</th>
                <th>Date</th>
                <th>Time</th>
                <th>Agency</th>
                <th>Status</th>
                <th>Extras</th>
            </tr>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->request_id }}</td>
                <td>{{ $booking->driver->name. ' '.$booking->driver->last_name }}</td>
                <td>{{ $booking->pax }}</td>
                <td>{{ $booking->service }}</td>
                <td>{{ $booking->client_name }}</td>
                <td>{{ substr($booking->hotel,0,20).'...' }}</td>
                <td>{{ $booking->flight }}</td>
                <td>{{ Carbon\Carbon::parse($booking->date)->format('d/m/y') }}</td>
                <td>{{ Carbon\Carbon::parse($booking->time)->format('H:i') }}</td>
                <td>{{ $booking->agency }}</td>
                <td>{{ $booking->status }}</td>
                <td>{{ $booking->extras }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
