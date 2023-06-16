function validateForm() {
        var fullName = document.getElementById("full_name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var qualifications = document.getElementById("qualifications").value;
        var resume = document.getElementById("resumeInput").value;

        if (fullName === "" || email === "" || phone === "" || qualifications === "" || resume === "") {
            alert("Please fill in all fields.");
            return false;
        }

        if (!isValidEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        if (!isValidPhone(phone)) {
            alert("Please enter a valid phone number.");
            return false;
        }

        return true;
    }

    function isValidEmail(email) {
        var emailRegex = /^\S+@\S+\.\S+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        var phoneRegex = /^\d{11}$/;
        return phoneRegex.test(phone);
    }