    <?php
    require_once 'koneksi.php'; // Adjust according to your database connection file

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['NKonsumen']);
        $email = mysqli_real_escape_string($conn, $_POST['Email']);
        $phone = mysqli_real_escape_string($conn, $_POST['NoTelp']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $address = mysqli_real_escape_string($conn, $_POST['AlamatKonsumen']);

        // Check if the username or email already exists
        $checkQuery = "SELECT * FROM konsumen WHERE NKonsumen = '$name' OR Email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Username or email already exists, send response
            $response = ('Username or email already exists');
            echo json_encode($response);
        } else {
            // Insert new record if username and email are unique
            $insertQuery = "INSERT INTO konsumen (IdKonsumen, NKonsumen, Password, AlamatKonsumen, NoTelp, Email) VALUES ('', '$name', '$password', '$address', '$phone', '$email')";

            if (mysqli_query($conn, $insertQuery)) {
                $response = ('Registration successful');
            } else {
                $response = ('Registration failed');
            }

            echo json_encode($response);
        }
    }
    ?>
