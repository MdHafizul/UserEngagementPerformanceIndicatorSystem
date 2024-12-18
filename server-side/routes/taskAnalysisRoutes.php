<?php

// CORS Headers
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS"); // Allow necessary HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow necessary headers

// Include necessary files
include_once '../models/taskAnalysisModel.php';
include_once '../controllers/taskAnalysisController.php';

// Instantiate TaskAnalysisController
$taskAnalysisController = new TaskAnalysisController();

// Route handling
$request_method = $_SERVER['REQUEST_METHOD']; // Get HTTP method (GET, POST, etc.)
$request_uri = $_SERVER['REQUEST_URI']; // Get the requested URI

// Extract the route parts (simplify the URL structure)
$url_parts = explode('/', parse_url($request_uri, PHP_URL_PATH));

// Check the action from the URL path
$action = end($url_parts);

// Get request body (for POST and PUT requests)
$data = json_decode(file_get_contents("php://input"), true);

// Log the incoming request for debugging
error_log("Request Method: " . $request_method);
error_log("Request URI: " . $request_uri);
error_log("Action: " . $action);
error_log("Data: " . json_encode($data));

// Route handling based on HTTP method and URL action
switch ($action) {
    case 'create': // POST request to create a task analysis
        if ($request_method == 'POST') {
            $taskAnalysisController->create($data);
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Method Not Allowed"]);
        }
        break;

    case 'read': // GET request for fetching all task analyses
        if ($request_method == 'GET') {
            $taskAnalysisController->read();
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Method Not Allowed"]);
        }
        break;

    case 'read_single': // GET request to get a single task analysis
        $id = $_GET['analysis_id'] ?? null;
        if ($id && $request_method == 'GET') {
            $taskAnalysisController->read_single($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Analysis ID is required"]);
        }
        break;

    case 'update': // PUT request to update a task analysis
        $id = $_GET['analysis_id'] ?? null;
        if ($id && $request_method == 'PUT') {
            $taskAnalysisController->update($id, $data);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Analysis ID is required"]);
        }
        break;

    case 'delete': // DELETE request to delete a task analysis
        $id = $_GET['analysis_id'] ?? null;
        if ($id && $request_method == 'DELETE') {
            $taskAnalysisController->delete($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Analysis ID is required"]);
        }
        break;

    case 'count_all': // GET request to count all task analyses
        if ($request_method == 'GET') {
            $taskAnalysisController->count_all();
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Method Not Allowed"]);
        }
        break;

    case 'count_by_user': // GET request to count task analyses by user ID
        $user_id = $_GET['user_id'] ?? null;
        if ($user_id && $request_method == 'GET') {
            $taskAnalysisController->count_by_user($user_id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "User ID is required"]);
        }
        break;

    case 'count_data_by_user': // GET request to count all types of data by user ID
        $user_id = $_GET['user_id'] ?? null;
        if ($user_id && $request_method == 'GET') {
            $taskAnalysisController->count_data_by_user($user_id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "User ID is required"]);
        }
        break;

    default: // Invalid request
        http_response_code(404);
        echo json_encode(["message" => "Not Found"]);
        break;
}
?>