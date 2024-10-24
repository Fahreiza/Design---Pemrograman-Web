<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<h1>Form Input dengan Validasi</h1>
<form id="myform" method="post" action="form_validation.php">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama">
    <span id="nama-error" style="color: red;"></span><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <span id="email-error" style="color: red;"></span><br>

    <input type="submit" value="Submit">
</form>
<script>
    $(document).ready(function() {
        $("#myform").submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var nama = $("#nama").val();
            var email = $("#email").val();
            var valid = true;

            if (nama === "") {
                $("#nama-error").text("Nama harus diisi.");
                valid = false;
            } else {
                $("#nama-error").text("");
            }

            if (email === "") {
                $("#email-error").text("Email harus diisi.");
                valid = false;
            } else {
                $("#email-error").text("");
            }

            if (valid) {
                // If valid, send data using AJAX
                $.ajax({
                    url: "form_validation.php", // Server-side PHP file
                    type: "POST",
                    data: {
                        nama: nama,
                        email: email
                    },
                    success: function(response) {
                        alert("Form submitted successfully!"); // Show success message
                        console.log(response); // Log response from server
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error); // Log error message if any
                    }
                });
            }
        });
    });
</script>
</body>
</html>