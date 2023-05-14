<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: index.php');
}

$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'web_development_wlb';

try {
    $conn = new PDO("mysql:host=$server_name;dbname=$database_name", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Not connected";
}

$query = "SELECT * FROM students WHERE id=$id";

$statement = $conn->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetch();

if (isset($_POST['update_data'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $query = "UPDATE students SET name='$name', address='$address', phone=$phone WHERE id=$id";
    $conn->query($query);
    $_SESSION['msg'] = "Data updated successfully";
    $_SESSION['class'] = 'success';
    header('location: index.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit And Update Student Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Student Data</h4>
                    </div>
                    <div class="card-body">
                        <small class="<?php echo $class ?? null ?>"><?php echo $msg ?? null ?></small>
                        <form action="" method="post">
                            <input type="text" value="<?php echo $result->name ?>" name="name" class="form-control" placeholder="Your Name">
                            <input type="text" value="<?php echo $result->address ?>" name="address" class="form-control mt-3" placeholder="Your Address">
                            <input type="text" value="<?php echo $result->phone ?>" name="phone" class="form-control mt-3" placeholder="Your Phone Number">
                            <div class="d-grid mt-3">
                                <button type="submit" name="update_data" class="btn btn-outline-success">Update
                                    Student Data</button>
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