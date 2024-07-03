<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if the 'pm10' and 'pm25' parameters are set in the URL
    if (isset($_GET['pm10']) && isset($_GET['pm25'])) {
        $pm10 = $_GET['pm10'];
        $pm25 = $_GET['pm25'];
        
        // Process the request based on pm10 and pm25
        // For demonstration, let's just return the pm10 and pm25 in a response
        $response = [
            'status' => 'success',
            'data' => [
                'pm10' => $pm10,
                'pm25' => $pm25
            ]
        ];
    } else {
        // Parameters 'pm10' or 'pm25' not provided
        $response = [
            'status' => 'error',
            'message' => 'Missing parameters: pm10 and/or pm25'
        ];
    }
    
    // Set header to return JSON content
    header('Content-Type: application/json');
    
    // Encode and return the response as JSON
    echo json_encode($response);
} else {
    // Handle non-GET requests here
}
?>