document.getElementById("registrationForm").addEventListener("submit", function(event) {
    let isValid = true;

    let firstName = document.getElementById("first-name").value.trim();
    let lastName = document.getElementById("last-name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm-password").value;

    document.getElementById("firstNameError").innerText = "";
    document.getElementById("lastNameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("phoneError").innerText = "";
    document.getElementById("passwordError").innerText = "";
    document.getElementById("confirmPasswordError").innerText = "";

    if (firstName === "") {
        document.getElementById("firstNameError").innerText = "First name is required";
        isValid = false;
    }
    if (lastName === "") {
        document.getElementById("lastNameError").innerText = "Last name is required";
        isValid = false;
    }
    if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        document.getElementById("emailError").innerText = "Invalid email format";
        isValid = false;
    }
    if (!phone.match(/^\d{10}$/)) {
        document.getElementById("phoneError").innerText = "Enter a valid 10-digit phone number";
        isValid = false;
    }
    if (password.length < 6) {
        document.getElementById("passwordError").innerText = "Password must be at least 6 characters";
        isValid = false;
    }
    if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").innerText = "Passwords do not match";
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});
