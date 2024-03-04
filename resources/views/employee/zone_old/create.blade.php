<!DOCTYPE html>
<html>
<head>
    <title>Create Polygon</title>
    <!-- Include Google Maps API with your API key -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn46rFOSG_dhB4c4D5wKECcKMXfzFb4-w&libraries=drawing"></script>
</head>
<body>
    <div id="map" style="height: 500px;"></div>
    
    <!-- Add multiple form input fields -->
    <form id="polygonForm">
        <div>
            <label for="polygonName">Polygon Name:</label>
            <input type="text" id="polygonName" name="polygonName" required>
        </div>
        <div>
            <label for="polygonDescription">Description:</label>
            <textarea id="polygonDescription" name="polygonDescription" required></textarea>
        </div>
        <!-- Add more input fields as needed -->
        <div>
            <label for="otherField">Other Field:</label>
            <input type="text" id="otherField" name="otherField">
        </div>
        <div>
            <label for="anotherField">Another Field:</label>
            <input type="text" id="anotherField" name="anotherField">
        </div>

        <button id="savePolygon">Save Polygon</button>
    </form>

    <script>
        var map;
        var polygon;
        var polygonCoords = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 28.635216, lng: 78.254136 },
                zoom: 12,
            });

            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: false,
            });

            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type === 'polygon') {
                    polygon = event.overlay;
                    polygon.getPath().forEach(function(coord, index) {
                        polygonCoords.push({
                            lat: coord.lat(),
                            lng: coord.lng(),
                        });
                    });
                }
            });

            document.getElementById('savePolygon').addEventListener('click', function(event) {
                // Send the polygon coordinates and form data to the server for saving
                savePolygon(polygonCoords);
            });
        }

        function savePolygon(coords) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('polygonForm'));
            formData.append('polygonData', JSON.stringify(coords));

            fetch('/admin/doj/employee/zone/save-polygon', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Polygon saved successfully');
                    location.reload(); // Reload the page after saving
                } else {
                    alert('Failed to save polygon');
                }
            })
            .catch(error => {
                // alert(error);
                console.error('Error:', error);
            });
        }

        initMap();
    </script>
</body>
</html>
