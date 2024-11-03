<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-CONTACT</title>
    <?php require ('inc/links.php');?>
</head>
<body class="bg-light">
    <!--Header-->
    <?php require ('inc/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">LIÊN HỆ</h2>
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
            <!--Items1-->
            <div class="col-lg-6 col-md-6 md-5 px-4 mb-4">
                <div class="bg-white rounded shadow p-4">

                    <!--MAP-->
                    <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28229.831991927833!2d109.25586900000002!3d12.22304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317066e1dd9688bb%3A0x6ae039c3dfc181db!2sVinpearl%20Resort%20Nha%20Trang!5e1!3m2!1svi!2sus!4v1730539444657!5m2!1svi!2sus""></iframe>
                    <h5>Địa chỉ</h5>
                    <a href="https://maps.app.goo.gl/ttSiQZuKfnQQ7gTd6" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i>City, Hon Tre Nha Trang, Vĩnh Nguyên, Nha Trang, Khánh Hòa 65000, Vietnam
                    </a>

                    <!--HOTLINE-->
                    <h5>Hotline</h5>
                    <a href="tel: +849057768899" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+84 9057768899
                    </a>
                    <br>
                    <a href="tel: +849057768899" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +84 8567842167
                    </a>

                    <!--Mail-->
                    <h5 class="mt-4 class="d-inline-block mb-2 text-decoration-none text-dark">Email</h5>
                    <i class="bi bi-envelope-fill"></i> <a href="mail: abc@gmail.com">abc@gmail.com</a>


                    <h5 class="mt-4 ">Follow us</h5>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                </div>
            </div>
            <!--Items2-->
            <div class="col-lg-6 col-md-6 md-5 px-4 mb-4">
                <div class="bg-white rounded shadow p-4">
                    <form>
                        <h5>
                            Send me a messasge!
                        </h5>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" style="font-weight: 500;" class="form-label">Name</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" style="font-weight: 500;" class="form-label">Email</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" style="font-weight: 500;" class="form-label">Subject</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" style="font-weight: 500;" class="form-label">Email</label>
                            <textarea class="form-control shadow-none row='5" style="resize: none;" id=""></textarea>
                        </div>
                        <button type="submit" class="btn text-white custom-bg mt-3">
                            GỬI
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php require ('inc/footer.php'); ?>


</body>
</html>