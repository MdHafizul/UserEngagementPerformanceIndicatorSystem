document.addEventListener("DOMContentLoaded", () => {
    const apiEndpoint = "http://localhost/your-api-endpoint"; // Replace with actual API URL

    // Fetch the user's profile data
    function fetchUserProfile() {
        fetch(apiEndpoint)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                // Dynamically update the HTML with the fetched data
                document.getElementById("profileName").innerHTML = data.name || "Not available";
                document.getElementById("userName").innerHTML = data.name || "Not available";
                document.getElementById("userEmail").innerHTML = data.email || "Not available";
                document.getElementById("userUsername").innerHTML = data.username || "Not available";
            })
            .catch((error) => {
                console.error("Error fetching user data:", error);
            });
    }

    // Show the edit user modal and pre-fill the form fields with current user data
    function showEditUserModal() {
        fetch(apiEndpoint)
            .then((response) => response.json())
            .then((data) => {
                document.getElementById("editUserName").value = data.name;
                document.getElementById("editUserEmail").value = data.email;
                document.getElementById("editUserUsername").value = data.username;
            })
            .catch((error) => console.error("Error fetching user data for edit:", error));
    }

    // Handle form submission for editing user details
    const editUserForm = document.getElementById("editUserForm");
    editUserForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const updatedUserData = {
            name: document.getElementById("editUserName").value,
            email: document.getElementById("editUserEmail").value,
            username: document.getElementById("editUserUsername").value,
        };

        fetch(`${apiEndpoint}/update`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(updatedUserData),
        })
            .then((response) => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text) });
                }
                return response.json();
            })
            .then(() => {
                alert("User updated successfully!");
                fetchUserProfile(); // Refresh profile data
                document.querySelector("#editUserModal .btn-close").click(); // Close the modal
            })
            .catch((error) => {
                console.error("Error updating user:", error);
            });
    });

    // Attach event listener to the "Edit User" button to trigger the modal
    const editUserBtn = document.getElementById("editUserBtn");
    editUserBtn.addEventListener("click", showEditUserModal);

    // Fetch and display user profile data on page load
    fetchUserProfile();
});
