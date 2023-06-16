
<!DOCTYPE html>
<html>
<head>
    <title>Resume Management Page</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <script src= "js/app.js" defer></script>

</head>
<body>

    <?php
        include("header.php");
    ?>
    <br><br><br><br>

    <div class="form-style-8">
        <h2>Enter Your Info</h2>
        <form id="myForm" method="POST" onsubmit="return validateForm();" enctype="multipart/form-data">
            <input type="text" name="full_name" placeholder="Full Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="phone" name="phone" placeholder="Phone" required />
            <input type="text" name="qualifications" placeholder="Qualifications" required />
            <label for="resumeInput">Resume</label>
            <input type="file" name="resume" id="resumeInput" accept=".pdf,.doc,.docx" required />
            <br><br>
            <input type="submit" value="Apply Now" />
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#myForm").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                url: "DB_Ops.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.startsWith("Error")) {
                        alert(response);
                    } else {
                        alert("Submitted Successfully");
                        form.trigger("reset");
                    }
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    alert("Submission Failed: " + errorMessage);
                }
            });
        });
    });
</script>

   
</body>

</html>
