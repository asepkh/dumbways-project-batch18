<?php
// Menghubungkan database
$connection = mysqli_connect("localhost", "root", "", "rmp_motor") or die( "Unable to connect");

// Membuat kondisional page dengan method $_GET | Ex : index.php?buy maka perintah dijalankan
if(isset($_GET['buy']))
{
    // Memastikan value dari form yang harus di isi tidak kosong
    if(!isset($_POST["name"]) || !isset($_POST["address"]) || !isset($_POST["phone"])){
        echo "<script>alert('Error : Fill The Form Exactly ....'); javascript:location.replace('index.php');</script>";
    }
    else
    {
        // Insert data pembeli dan mengurangi stock product
        $query = mysqli_query($connection, "SELECT motorcycle_tb.stock as stock FROM motorcycle_tb WHERE id = '".$_POST['motorcycle_id']."'");
        $data = mysqli_fetch_assoc($query);
        $minus1stock = $data['stock']-1;

        $query_2 = 'INSERT INTO customer_tb (name, address, phone, motorcycle_id)
        VALUES ("'.$_POST["name"].'", "'.$_POST["address"].'", "'.$_POST["phone"].'", "'.$_POST["motorcycle_id"].'");';
        $query_2 .= 'UPDATE motorcycle_tb SET stock='.$minus1stock.' WHERE id = '.$_POST['motorcycle_id'].'';
        
        // Memastikan query berhasil
        if(mysqli_multi_query($connection, $query_2)) {
            echo "<script>alert('Motorcycle successfully purchase'); javascript:location.replace('index.php');</script>";
        } else {
            echo "<script>alert('Error: something happen'); javascript:location.replace('index.php');</script>";
        }
    }
} else if(isset($_GET['add_product']))
{
    if(!isset($_POST["name"]) || !isset($_POST["color"]) || !isset($_POST["specification"]) || !isset($_POST["image"]) || !isset($_POST["stock"])){
        echo "<script>alert('Error : Fill The Form Exactly ....'); javascript:location.replace('index.php');</script>";
    }
    else
    {
        $query = "INSERT INTO motorcycle_tb(`name`, `brand_id`, `image`, `color`, `specification`, `stock`)
        VALUES ('".$_POST['name']."', '".$_POST['brand']."', '".$_POST['image']."',  '".$_POST['color']."', '".$_POST['specification']."', '".$_POST['stock']."');";

        if(mysqli_query($connection, $query)) {
            echo "<script>alert('Motorcycle product successfully added'); javascript:location.replace('index.php');</script>";
        } else {
           echo "<script>alert('Error: something happen'); javascript:location.replace('index.php');</script>";
        }
    }
} else if(isset($_GET['add_brand']))
{
    
    if(!isset($_POST["name"])){
        echo "<script>alert('Error Fill The Form Exactly ....'); javascript:location.replace('index.php');</script>";
    }
    else
    {
        $query = 'INSERT INTO brand_tb(name) VALUES ("'.$_POST["name"].'");';
    
        if(mysqli_query($connection, $query)) {
            echo "<script>alert('Motorcycle brand successfully added'); javascript:location.replace('index.php');</script>";
        } else {
            echo "<script>alert('Error: something happen'); javascript:location.replace('index.php');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>RMP Motorcycle</title>
</head>
<body class="bg-primary">
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <a class="navbar-brand" href="#"><b>RMP Motorcycle</b></a>
    </nav>

    <!-- content -->
    <div class="container-fluid mt-2 row">
        <div class="container col-md-9 row" style="padding-left: 5%;">
            <?php
                // Query untuk menampilkan tabel product motor
                $query = "SELECT motorcycle_tb.id as id, motorcycle_tb.name as name, motorcycle_tb.image as image, motorcycle_tb.color as color, motorcycle_tb.stock as stock, motorcycle_tb.specification as specification, brand_tb.name as brand_name FROM motorcycle_tb join brand_tb on motorcycle_tb.brand_id = brand_tb.id";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                    /* Query untuk menampilkan tabel product motor 
                        Jika stock motor kosong maka tidak bisa di beli
                        Setiap form pembelian ada hidden value untuk input id motor ke pembelian untuk costumer
                    */
                    echo '<div class="col-md-4 p-2">
                                <div class="card">
                                    <img src="'.$row["image"].'" class="card-img-top img-fluid" alt="'.$row["name"].'">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$row["name"].' || '.$row["color"].'</h5>
                                        <p class="card-text">'.$row["brand_name"].' || Stock : '.$row["stock"].'</p>
                                        <p>
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#detail_'.$row["id"].'" aria-expanded="false" aria-controls="collapseExample">
                                                Specification
                                            </button> ';
                                            if($row['stock'] > 0){ echo '<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#buy_'.$row["id"].'" aria-expanded="false" aria-controls="collapseExample">Buy</button>'; }
                                            else { echo '<button class="btn btn-danger" type="button" >Not Available</button>'; }
                                            echo '</p>
                                            <div class="collapse" id="detail_'.$row["id"].'">
                                            <div class="card card-body">
                                             '.$row["specification"].'
                                            </div>
                                            </div>
                                            <div class="collapse" id="buy_'.$row["id"].'">
                                                <form action="?buy" method="post">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Handphone Number</label>
                                                        <input type="text" class="form-control" name="phone" placeholder="Ex : +62 xxx - xxxx - xxxx">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" name="address" placeholder="JL. Selamet No. XX, Bekasi Selatan">
                                                        <input type="hidden" name="motorcycle_id" value="'.$row["id"].'">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success mb-2">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo "No Result";
                }
            ?>
        </div>
        <div class="container col-md-3">
            <ul class="list-group mt-2">
            <li class="list-group-item" style="text-align: center;"><b>Motorcycle Brand</b></li>
                <?php
                     // Query untuk menampilkan tabel brand product
                    $query = "SELECT * FROM brand_tb";
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $result_2 = mysqli_query($connection, 'SELECT * FROM motorcycle_tb where brand_id='.$row["id"].'');
                            $total = mysqli_num_rows($result_2);
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">'.$row["name"].'  <span class="badge badge-primary badge-pill">'.$total.'</span></li>';
                        }
                    } else {
                        echo "No results";
                    }
                ?>
            </ul>
            <form class="mt-3" action="?add_product" method="post">
                <div class="card bg-light p-2"> 
                    <h5 class="card-title">Add New Motorcycle Product</h5>
                    <div class="form-group">
                        <label for="name">Motorcycle Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Ex : Vega ZR or something">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select class="form-control" name="brand">
                            <?php
                                $query = "SELECT * FROM brand_tb";
                                $result = mysqli_query($connection, $query);
                                if (mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                } else {
                                    echo '<option>No Result</option>';
                                }
                                mysqli_close($connection);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" placeholder="Motorcycle Color, Ex : Green">
                    </div>
                    <div class="form-group">
                        <label for="specification">Specification</label>
                        <textarea class="form-control" name="specification" placeholder="" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image Url</label>
                        <input type="text" class="form-control" name="image" placeholder="http://wwww.imgur.com/image.jpeg">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control" name="stock" placeholder="Product Stock, Ex: 4">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-1">Add Product</button>
                    </div>
                </div>
            </form>
            <form id="addtype" class="mt-3" action="?add_brand" method="post">
                <div class="card bg-light p-2"> 
                    <h5 class="card-title" >Add New Motorcycle Brand</h5>
                    <div class="form-group">
                        <label for="name">Brand Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Ex : Kawasaki">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Add Brand</button>
                    </div>
                </div>
            </form><br/>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>