<?php
// Include necessary files
include_once '../models/taskModel.php';
include_once '../controllers/taskController.php';

// Instantiate TaskController
$taskController = new TaskController();

//Route handling
$request_method = $_SERVER['REQUEST_METHOD']; // Get HTTP method (GET, POST, etc.)
$request_uri = $_SERVER['REQUEST_URI']; // Get the requested URI

//Extract the route parts (simplify the URL structure)
$url_parts = explode('/', parse_url($request_uri, PHP_URL_PATH));

//Check the action from the URL path
$action = end($url_parts);

//Get request body (for POST and PUT requests)
$data = json_decode(file_get_contents("php://input"), true);

//Route handling based on HTTP method and URL action
switch ($action) {
    case 'create': //Post request to create a task
        if ($request_method == 'POST') {
            $taskController->create($data);
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Method Not Allowed"]);
        }
        break;

    case 'read': //GET request for fetching all tasks
        if ($request_method == 'GET') {
            $taskController->read();
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Method Not Allowed"]);
        }
        break;

    case 'read_single': //GET request to get a single task
        $id = $_GET['task_id'] ?? null;
        if ($id && $request_method == 'GET') {
            $taskController->read_single($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Task ID is required"]);
        }
        break;
    case 'update': //PUT request to update a task
        $id = $_GET['task_id'] ?? null;
        if ($id && $request_method == 'PUT') {
            $taskController->update($id, $data);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Task ID is required"]);
        }
        break;
    case 'delete': //DELETE request to delete a task
        $id = $_GET['task_id'] ?? null;
        if ($id && $request_method == 'DELETE') {
            $taskController->delete($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Task ID is required"]);
        }
        break;

    default:    //Invalid request
        http_response_code(404);
        echo json_encode(["message" => "Not Found"]);
        break;
}
?>