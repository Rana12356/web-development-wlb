<?php

session_start();

$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'web_development_wlb';

try {
    $conn = new PDO("mysql:host=$server_name;dbname=$database_name", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Not connected" . $e->getMessage();
}

// $query = "CREATE TABLE students (
//     id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name varchar(40) NULL, 
//     address varchar(150) NULL,
//     phone varchar(15) NULL 
// )";

// try {
//     $conn->query($query);
//     echo "Table created successfully";
// } catch (PDOException $e) {
//     echo "Table not created" . $e->getMessage();
// }

if (isset($_POST['insert_data'])) {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $data = "INSERT INTO students (name, address, phone) VALUES ('$name', '$address', '$phone')";

    try {
        $conn->query($data);
        $_SESSION['msg'] = "Data inserted successfully";
        $_SESSION['class'] = 'success';
        header('location: index.php');
    } catch (PDOException $e) {
        $msg = "Data not inserted";
        $class = 'text-danger';
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Create Student Data</h4>
                    </div>
                    <div class="card-body">
                        <small class="<?php echo $class ?? null ?>"><?php echo $msg ?? null ?></small>
                        <form action="" method="post">
                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                            <input type="text" name="address" class="form-control mt-3" placeholder="Your Address">
                            <input type="text" name="phone" class="form-control mt-3" placeholder="Your Phone Number">
                            <div class="d-grid mt-3">
                                <button type="submit" name="insert_data" class="btn btn-outline-success">Insert
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>