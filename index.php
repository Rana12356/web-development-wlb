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
    echo "Not connected";
}


$query = "SELECT * FROM students";

try {
    $statement = $conn->prepare($query);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $results = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Data could not be shown";
}

// foreach ($results as $result) {
//     echo "<pre>";
//     print_r($result);
// }

if (isset($_POST['delete_data'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM students WHERE id=$id";
    $conn->query($query);
    header('location: index.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0 text-center">Manage Student Data</h4>
                            <a href="create.php"><button type="submit" class="btn btn-sm btn-success"><i
                                        class="fa-solid fa-plus"></i></button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-<?php echo $_SESSION['class'] ?>"><?php echo $_SESSION['msg'] ?></div>
                        <?php }
                        session_unset();
                        ?>
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 1;
                                foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo $sl++ ?></td>
                                    <td><?php echo $result->name ?></td>
                                    <td><?php echo $result->address ?></td>
                                    <td><?php echo $result->phone ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="show.php?id=<?php echo $result->id ?>"><button
                                                    class="btn btn-sm btn-info me-1"><i
                                                        class="fa-solid fa-eye"></i></button></a>
                                            <a href="edit.php?id=<?php echo $result->id ?>"><button
                                                    class="btn btn-sm btn-warning me-1"><i
                                                        class="fa-solid fa-edit"></i></button></a>
                                            <form action="" method="post"
                                                onsubmit="return confirm('Are you sure want to delete this data?')">
                                                <input type="hidden" name="id" value="<?php echo $result->id ?>">
                                                <button type="submit" name="delete_data"
                                                    class="btn btn-sm btn-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>