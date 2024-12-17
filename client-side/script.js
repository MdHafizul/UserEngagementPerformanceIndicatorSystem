const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

// Toggle panel for sign-up and sign-in
signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// Handle Sign-Up Form Submission
document.getElementById('signUpForm').addEventListener('submit', async (event) => {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    try {
        const response = await fetch('http://localhost/Naluri/server-side/routes/userRoutes.php/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name,
                email,
                username,
                password,
                user_type: 'patient'
            })
        });

        const result = await response.json();

        if (response.ok) {
            alert("Account created successfully! Please sign in.");
            container.classList.remove("right-panel-active"); // Switch to sign-in panel
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error("Sign-Up Error:", error);
        alert("An error occurred during sign-up. Please try again later.");
    }
});

// Handle Sign-In Form Submission
document.getElementById('signInForm').addEventListener('submit', async (event) => {
    event.preventDefault();

    const email = document.getElementById('signinEmail').value.trim();
    const password = document.getElementById('signinPassword').value.trim();

    try {
        const response = await fetch('http://localhost/Naluri/server-side/routes/userRoutes.php/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email,
                password,
            })
        });

        const result = await response.json();

        if (response.ok) {
            alert("Login successful!");
            if (result.user_type === 'employee') {
                window.location.href = "/Naluri/client-side/pages/employeePages/dashboard.php"; // Redirect to the employee dashboard
            } else if (result.user_type === 'admin') {
                window.location.href = "/Naluri/client-side/pages/dashboard.php"; // Redirect to the general dashboard
            } else if (result.user_type === 'patient') {
                window.location.href = "/Naluri/client-side/pages/patientPages/dashboard.php"; // Redirect to the patient dashboard
            } else {
                alert("You are not authorized to access any dashboard.");
            }
        } else {
            alert(`Error: ${result.message}`);
        }

    } catch (error) {
        console.error("Sign-In Error:", error);
        alert("An error occurred during login. Please try again later.");
    }
});
