<?php

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

try {
    $statement = $conn->prepare($query);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();
} catch (PDOException $e) {
    echo "Data could not be shown";
}

// echo "<pre>";
// print_r($result);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Single Student Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">Show Student Data</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-stripped">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td><?php echo $result->id ?></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $result->name ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $result->address ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $result->phone ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="index.php"><button class="btn btn-sm btn-success">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>