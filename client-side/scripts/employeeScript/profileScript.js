document.addEventListener("DOMContentLoaded", () => {
    const apiEndpoint = `http://localhost/Naluri/server-side/routes/userRoutes.php/read_single?user_id=${userId}`;
    const profileCard = document.getElementById("profile-card");

    console.log("Script loaded. User ID:", userId); // Debugging

    // Fetch user profile data
    function fetchUserProfile() {
        console.log("Attempting to fetch user profile from:", apiEndpoint); // Debugging

        fetch(apiEndpoint)
            .then((response) => {
                console.log("Received response:", response); // Debugging response object

                if (!response.ok) {
                    console.error("Network response was not ok. Status:", response.status);
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((user) => {
                console.log("Fetched user data:", user); // Debugging user data

                profileCard.innerHTML = `
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img id="profileImage" src="${user.profile_image || '../../assets/img/bruce-mars.jpg'}" class="rounded-circle img-fluid" style="width: 100px;" />
                                </div>
                                <h4 id="profileName" class="mb-2">${user.name}</h4>
                                <table class="table table-bordered mt-4">
                                    <tr>
                                        <th>Name</th>
                                        <td id="userName">${user.name}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="userEmail">${user.email}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td id="userUsername">${user.username}</td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary mt-4" id="editUserBtn" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                `;

                console.log("Profile successfully loaded and rendered."); // Debugging

                // Add event listener for the edit button
                document.getElementById("editUserBtn").addEventListener("click", () => {
                    console.log("Edit Profile button clicked. Showing modal...");
                    showEditUserModal(user);
                });
            })
            .catch((error) => {
                console.error("Error fetching user profile:", error.message); // Debugging errors
                profileCard.innerHTML = `
                    <div class="col-12 text-center text-danger">
                        Failed to load profile data. Please try again later.
                    </div>
                `;
            });
    }

    // Show the edit user modal with pre-filled data
    function showEditUserModal(user) {
        console.log("Populating edit modal with user data:", user); // Debugging

        document.getElementById("editUserName").value = user.name || '';
        document.getElementById("editUserEmail").value = user.email || '';
        document.getElementById("editUserUsername").value = user.username || '';
        document.getElementById("editUserPassword").value = ''; // Clear password field for security

        console.log("Edit modal populated."); // Debugging
    }

    // Fetch the user profile on page load
    fetchUserProfile();
});
