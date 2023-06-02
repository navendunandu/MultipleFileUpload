<?php
include('Assets/Connection/Connection.php');
$flag=0;
if(isset($_POST['btnupload']))
{
    $photos=$_FILES['photos'];
    for ($i = 0; $i < count($photos['name']); $i++) {
        $photoName = $photos['name'][$i];
        $photoTmpName = $photos['tmp_name'][$i];
        move_uploaded_file($photoTmpName, 'Assets/Files/'.$photoName);
        $query = "INSERT INTO tbl_gallery (gallery_file) VALUES ('$photoName')";
        if($conn->query($query))
        {
            $flag++;
        }
    }
    if($flag==$i)
    {
        echo '<script>alert("Upload Successfull");</script>';
    }
    else{
        ?>
        <script>alert("Only <?php echo $flag ?> Uploaded. Remaining Failed!");</script>'
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Files Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/CSS/style.css">
</head>

<body>
    <div class="container" align="center">
        <div class="form">
            <h3 class="font-monospace text-uppercase">Multiple File Upload</h3>
            <form action="" enctype="multipart/form-data" method="post">
                <input class="form-control" type="file" id="formFileMultiple" multiple name="photos[]" required/>
                <input type="submit" value="Upoad" name="btnupload" class="btn w-100 mt-10 btn-primary">
            </form>
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <section class="bg-image">
        <div class="container">
            <div class="row" id="gallery">
                <?php
                $gallery="select * from tbl_gallery";
                $res=$conn->query($gallery);
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        ?>
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <img class="w-100 shadow-1-strong rounded mb-4 img-thumbnail"
                        src="Assets/Files/<?php echo $row['gallery_file'] ?>"
                        alt="<?php echo $row['gallery_file'] ?>" />
                </div>
                <?php
                    }
                }
                else
                {
                    echo "<h1 align='center'>Gallery Empty</h1>";
                }
                ?>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>

</html>