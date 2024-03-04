<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geofencing App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Include Bootstrap JavaScript after jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <hr>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Map Container -->
        <div id="map" style="height: 500px;"></div>

        <!-- Geofence Form -->
        <h2>Create Geofence</h2>
        <form method="POST" action="/geofences">
            @csrf

            <div class="form-group">
                <label for="name">Geofence Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <input type="hidden" name="coordinates" id="coordinates" value="">

            <button type="submit" class="btn btn-primary">Save Geofence</button>
        </form>
    </div>

    <!-- Include the Google Maps API script with the "drawing" and "geometry" libraries -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn46rFOSG_dhB4c4D5wKECcKMXfzFb4-w&libraries=drawing,geometry"></script>

    <!-- JavaScript for initializing the map and handling geofencing -->
    <script>
        let map;
        let drawingManager;
        let geofenceCoordinates = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 28.635216, lng: 78.254136 },
                zoom: 10,
            });

            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon'],
                },
            });

            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type === 'polygon') {
                    geofenceCoordinates = event.overlay.getPath().getArray();
                    document.getElementById('coordinates').value = JSON.stringify(geofenceCoordinates);
                }
            });
        }
    </script>

    <!-- Initialize the map -->
    <script>
        initMap();
    </script>
</body>
</html>
