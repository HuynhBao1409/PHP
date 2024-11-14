<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-FACILITIES</title>
    <?php require ('inc/links.php');?>
    <style>
        .pop:hover{
            border-top-color: #2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3;
        }
    </style>
</head>
<body class="bg-light">
    <!--Header-->
    <?php require ('inc/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">TIỆN ÍCH</h2>
        <hr class="w-50 mx-auto">
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Aspernatur at atque, cumque deleniti dolorem dolorum ex id,<br>
            ipsa natus nemo quibusdam quo quos ratione recusandae sed tempore vitae.
            Accusamus, porro.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php
                 $res = selectAll('facilities');
                 $path = FACILITIES_IMG_PATH;

                 while($row = mysqli_fetch_assoc($res)){
                     echo<<<data
                        <!--Items-->
                        <div class="col-lg-4 col-md-6 md-5 px-4 mb-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="$path$row[icon]" width="40px">
                                    <h5 class="m-0 ms-2">$row[name]</h5>
                                </div> 
                                <p>$row[description]</p>
                            </div>
                        </div>
                       data;

                 }
            ?>
        </div>
    </div>

    <!--Footer-->
    <?php require ('inc/footer.php'); ?>


</body>
</html>