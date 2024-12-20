<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header('Location: /Naluri/client-side/index.php');
    exit();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'patient') {
    header('Location: /Naluri/client-side/index.php');
    exit();
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/naluri.png">
    <link rel="icon" type="image/png" href="../../assets/img/naluri.png">
    <title>Task Pages</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0"
                href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
                <img src="../../assets/img/naluri.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
                <span class="ms-1 text-sm text-dark">Naluri</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="./recommendation.php">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Recommendation</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bg-gradient-dark text-white" href="./task.php">
                        <i class="material-symbols-rounded opacity-5">task</i>
                        <span class="nav-link-text ms-1">Task</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="./resource.php">
                        <i class="material-symbols-rounded opacity-5">folder</i>
                        <span class="nav-link-text ms-1">Resource</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="./profile.php">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <!-- Additional Navigation Links -->
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <a class="btn bg-gradient-dark w-100" href="?action=logout" type="button">Logout</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Task</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Type here...</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Task List</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="taskTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Title</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Description</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Due Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hidden input to store user ID -->
        <input type="hidden" id="userId" value="<?php echo $user_id; ?>">
    </main>

    <!-- Submit Task Modal -->
    <div class="modal fade" id="submitTaskModal" tabindex="-1" aria-labelledby="submitTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-radius-lg">
                <div class="modal-header bg-gradient-dark text-white">
                    <h5 class="modal-title fw-bold" id="submitTaskModalLabel">Submit Task</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitTaskForm">
                        <!-- Task Done -->
                        <div class="mb-4">
                            <label for="taskDone" class="form-label fw-semibold">Task Done</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="taskDone">
                                <label class="form-check-label ms-1" for="taskDone">Yes</label>
                            </div>
                        </div>
                        <!-- Time Taken -->
                        <div class="mb-4">
                            <label for="timeTaken" class="form-label fw-semibold">Time Taken</label>
                            <input type="text" class="form-control border-radius-lg" id="timeTaken"
                                placeholder="Enter time taken">
                        </div>
                        <!-- Video Watched -->
                        <div class="mb-4">
                            <label for="videoWatched" class="form-label fw-semibold">Video Watched</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="videoWatched">
                                <label class="form-check-label ms-1" for="videoWatched">Yes</label>
                            </div>
                        </div>
                        <!-- Article Read -->
                        <div class="mb-4">
                            <label for="articleRead" class="form-label fw-semibold">Article Read</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="articleRead">
                                <label class="form-check-label ms-1" for="articleRead">Yes</label>
                            </div>
                        </div>
                        <!-- Book Read -->
                        <div class="mb-4">
                            <label for="bookRead" class="form-label fw-semibold">Book Read</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="bookRead">
                                <label class="form-check-label ms-1" for="bookRead">Yes</label>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn bg-gradient-dark text-white w-100 border-radius-lg">
                            Submit Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const userId = document.getElementById("userId").value;
            console.log("User ID:", userId);
            const apiEndpoint = `http://localhost/Naluri/server-side/routes/userTaskRoutes.php/read_by_user?user_id=${userId}`;
            const taskTableBody = document.querySelector("#taskTable tbody");

            // Fetch task data for the logged-in user
            function fetchTaskData() {
                fetch(apiEndpoint)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        console.log("Fetched data:", data); // Log the fetched data

                        // Check if data is an array
                        if (!Array.isArray(data)) {
                            throw new Error("Data is not an array");
                        }

                        // Clear existing rows
                        taskTableBody.innerHTML = "";

                        // Populate table rows
                        data.forEach((task) => {
                            const row = document.createElement("tr");

                            row.innerHTML = `
                        <td>${task.title}</td>
                        <td>${task.description}</td>
                        <td class="text-center">${task.due_date}</td>
                        <td class="text-center">${task.status}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm submitTaskBtn" data-id="${task.user_task_id}">Submit Task</button>
                        </td>
                    `;

                            taskTableBody.appendChild(row);
                        });

                        // Add event listeners for submit task buttons
                        document.querySelectorAll(".submitTaskBtn").forEach((button) => {
                            button.addEventListener("click", (event) => {
                                const taskId = event.target.getAttribute("data-id");
                                console.log("Task ID:", taskId); // Debugging statement
                                showSubmitTaskModal(taskId);
                            });
                        });
                    })
                    .catch((error) => {
                        console.error("Error fetching task data:", error);
                        taskTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-danger">Failed to load task data.</td>
                    </tr>
                `;
                    });
            }

            // Show the submit task modal
            function showSubmitTaskModal(taskId) {
                // Store the current task ID
                document.getElementById("submitTaskForm").setAttribute("data-task-id", taskId);
                const submitTaskModal = new bootstrap.Modal(document.getElementById("submitTaskModal"));
                submitTaskModal.show();
            }

            // Handle form submission for submitting task
            document.getElementById("submitTaskForm").addEventListener("submit", (event) => {
                event.preventDefault();

                const taskId = event.target.getAttribute("data-task-id");
                const taskDone = document.getElementById("taskDone").checked;
                const timeTaken = document.getElementById("timeTaken").value;
                const videoWatched = document.getElementById("videoWatched").checked;
                const articleRead = document.getElementById("articleRead").checked;
                const bookRead = document.getElementById("bookRead").checked;

                const data = {
                    user_task_id: parseInt(taskId),
                    is_task_done: taskDone,
                    time_taken_in_hours: parseFloat(timeTaken),
                    article_watched: articleRead,
                    video_watched: videoWatched,
                    books_read: bookRead
                };

                console.log("Submitting data:", data); // Debugging statement

                fetch('http://localhost/Naluri/server-side/routes/taskAnalysisRoutes.php/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        console.log("Response status:", response.status); // Debugging statement
                        return response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (error) {
                                console.error("Failed to parse JSON:", text);
                                throw error;
                            }
                        });
                    })
                    .then(result => {
                        console.log("Result:", result); // Debugging statement
                        if (result.success) {
                            alert('Task submitted successfully!');
                            // Optionally, you can hide the modal here
                            const submitTaskModal = bootstrap.Modal.getInstance(document.getElementById("submitTaskModal"));
                            submitTaskModal.hide();

                            // Call the delete function to delete the user task
                            deleteUserTask(taskId);
                        } else {
                            alert('Failed to submit task: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting task:', error);
                        alert('An error occurred while submitting the task.');
                    });
            });

            // Function to delete user task
            function deleteUserTask(taskId) {
                fetch(`http://localhost/Naluri/server-side/routes/userTaskRoutes.php/delete?user_task_id=${taskId}`, {
                    method: 'DELETE'
                })
                    .then(response => response.json())
                    .then(result => {
                        console.log("Delete result:", result); // Debugging statement
                        if (result.success) {
                            fetchTaskData();
                        } else {
                            alert('Failed to delete user task: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting user task:', error);
                        alert('An error occurred while deleting the user task.');
                    });
            }

            // Initial fetch of task data
            fetchTaskData();
        });
    </script>
    <!-- Include Bootstrap JS for modal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>