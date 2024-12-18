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

function sanitizeInput(input) {
    const element = document.createElement('div');
    element.innerText = input;
    return element.innerHTML;
}

// Handle Sign-Up Form Submission
document.getElementById('signUpForm').addEventListener('submit', async (event) => {
    event.preventDefault();

    const name = sanitizeInput(document.getElementById('name').value.trim());
    const email = sanitizeInput(document.getElementById('email').value.trim());
    const username = sanitizeInput(document.getElementById('username').value.trim());
    const password = sanitizeInput(document.getElementById('password').value.trim());

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

    const email = sanitizeInput(document.getElementById('signinEmail').value.trim());
    const password = sanitizeInput(document.getElementById('signinPassword').value.trim());

    try {
        const response = await fetch('http://localhost/Naluri/server-side/routes/userRoutes.php/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email,
                password
            })
        });

        const result = await response.json();

        if (response.ok) {
            alert("Signed in successfully!");
            // Redirect to dashboard or appropriate page
            window.location.href = result.redirectUrl;
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error("Sign-In Error:", error);
        alert("An error occurred during sign-in. Please try again later.");
    }
});