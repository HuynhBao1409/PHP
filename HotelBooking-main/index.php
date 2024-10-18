<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <!-- Bootraps 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- CSS -->
     <link rel="stylesheet" href="css/common.css">
    <style>
        .availabity-form{
          margin-top: -50px;
          z-index: 2;
          position: relative;
        }
        @media screen and (max-width: 575px){
          .availabity-form{
            margin-top: 25px;
            padding: 0 35px;
          }
        }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 px-lg-2 shadow-sm ssticky-top">
  <div class="container-fluid">
    <a class="navbar-brand mx-2 fw-bold fs-3 h-font" href="index.php">HOTEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active mx-2" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#">About</a>
        </li>
      </ul>
      <div class="d-flex">
        <button type="button" class="btn btn-outline-dark shadow-none mx-lg-3 mx-3" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
        </button>
        <button type="button" class="btn btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
            <i class="bi bi-person-circle fs-3 mx-2"></i> User Login
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control shadow-none">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" id="password" class="form-control">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-dark shadow-none">
                LOGIN
            </button>
            <a href="#" class="text-secondary text-decoration-none">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <i class="bi bi-person-vcard"></i> User Registration
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="container">
          <div class="row">
            <div class="col-md-6 ps-0 mb-3">
              <label classs="form-label">Name</label>
              <input type="text" class="form-control shadow-none">
            </div>
            <div class="col-md-6 p-0">
              <label classs="form-label">Email</label>
              <input type="email" class="form-control shadow-none">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 col-md-6 ps-0 mb-3">
              <label classs="form-label">Phone Number</label>
              <input type="number" class="form-control shadow-none">
            </div>
            <div class="col-lg-5 col-md-6 p-0">
              <label classs="form-label">Picture</label>
              <input type="file" class="form-control shadow-none">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-6 ps-0 mb-3">
              <label classs="form-label">Andress</label>
              <textarea class="form-control shadow-none" id=""></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-6 ps-0 mb-3">
              <label classs="form-label">Date of Birth</label>
              <input type="date" class="form-control shadow-none">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 ps-0 mb-3">
              <label for="password1" class="form-label">Password</label>
              <div class="input-group">
                  <input type="password" id="password1" class="form-control shadow-none">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                      <i class="bi bi-eye" id="eyeIcon1"></i>
                  </button>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 ps-0 mb-3">
              <label for="password2" class="form-label">Confirm Password</label>
              <div class="input-group">
                  <input type="password" id="password2" class="form-control">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                      <i class="bi bi-eye" id="eyeIcon2"></i>
                  </button>
              </div>
            </div>

          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-dark shadow-none">
                REGISTER
            </button>
            <a href="#" class="text-secondary text-decoration-none">Already have account?</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Carousel -->
 <!-- Swiper -->
<div class="contrainer-fluid px-lg-4 mt-4">

  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="images/carousel/1.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
          <img src="images/carousel/2.png" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide">
          <img src="images/carousel/3.png" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide">
          <img src="images/carousel/4.png" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide">
          <img src="images/carousel/5.png" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide">
          <img src="images/carousel/6.png" class="w-100 d-block"/>
      </div>
  </div>
  
</div>

 <!-- Form Check Booking -->
  <div class="container availabity-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4"> Check Booking Availabity</h5>
        <form>
          <div class="row align-items-end">
              <div class="col-lg-3 mb-3">
                <label classs="form-label" sytle="font-weight: 500;">Check-in</label>
                <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-3 mb-3">
                <label classs="form-label" sytle="font-weight: 500;">Check-out</label>
                <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-3 mb-3">
                <label classs="form-label" sytle="font-weight: 500;">Adult</label>
                <select class="form-select shadow-none">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-lg-2 mb-3">
                <label classs="form-label" sytle="font-weight: 500;">Children</label>
                <select class="form-select shadow-none">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-lg-1 mb-lg-3 mt-2">
                <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- List Rooms -->
   <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Danh sách các phòng</h2>
  <div class="container">
    <div class="row">
      <!-- Room 1 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow " style="max-width: 350px; margin: auto;">
          <img src="images/rooms/1.jpg" class="card-img-top">
          <div class="card-body">
            <h5 >Phòng Đơn</h5>
            <h6 class="mb-4">2tr999 VND/ngày</h6>
            <div class="features mb-4">
                <h6 class="mb-1">Mô tả</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathrooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  1 Living Room
                </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Con ghẹ đít bự
                </span>
            </div>
            <div class="facilites mb-4">
              <h6 class="mb-1">Cơ sở vật chất</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                Wifi 5G
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                2 TV
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                1 Infinity Pool
              </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                Ghế tình yêu
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Đánh giá</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span> 
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Thêm chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Room 2 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow " style="max-width: 350px; margin: auto;">
          <img src="images/rooms/1.jpg" class="card-img-top">
          <div class="card-body">
            <h5 >Phòng Đơn</h5>
            <h6 class="mb-4">2tr999 VND/ngày</h6>
            <div class="features mb-4">
                <h6 class="mb-1">Mô tả</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathrooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  1 Living Room
                </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Con ghẹ đít bự
                </span>
            </div>
            <div class="facilites mb-4">
              <h6 class="mb-1">Cơ sở vật chất</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                Wifi 5G
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                2 TV
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                1 Infinity Pool
              </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                Ghế tình yêu
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Đánh giá</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span> 
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Thêm chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Room 3 -->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow " style="max-width: 350px; margin: auto;">
          <img src="images/rooms/1.jpg" class="card-img-top">
          <div class="card-body">
            <h5 >Phòng Đơn</h5>
            <h6 class="mb-4">2tr999 VND/ngày</h6>
            <div class="features mb-4">
                <h6 class="mb-1">Mô tả</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Bathrooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap ">
                  1 Living Room
                </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                  2 Con ghẹ đít bự
                </span>
            </div>
            <div class="facilites mb-4">
              <h6 class="mb-1">Cơ sở vật chất</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                Wifi 5G
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                2 TV
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap ">
                1 Infinity Pool
              </span><span class="badge rounded-pill bg-light text-dark text-wrap ">
                Ghế tình yêu
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Đánh giá</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span> 
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Thêm chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
      </div>
    </div>
  </div>
  <br><br><br>
  <br><br><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // ẩn hiện pass
    document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';
    eyeIcon.classList.toggle('bi-eye', !isPassword);
    eyeIcon.classList.toggle('bi-eye-slash', isPassword);
    });

    document.getElementById('togglePassword1').addEventListener('click', function () {
    const passwordInput = document.getElementById('password1');
    const eyeIcon = document.getElementById('eyeIcon1');
    const isPassword = passwordInput.type === 'password';
    
    passwordInput.type = isPassword ? 'text' : 'password';
    eyeIcon.classList.toggle('bi-eye', !isPassword);
    eyeIcon.classList.toggle('bi-eye-slash', isPassword);
    });

  // Xử lý ẩn hiện password thứ hai
    document.getElementById('togglePassword2').addEventListener('click', function () {
    const passwordInput = document.getElementById('password2');
    const eyeIcon = document.getElementById('eyeIcon2');
    const isPassword = passwordInput.type === 'password';
    
    passwordInput.type = isPassword ? 'text' : 'password';
    eyeIcon.classList.toggle('bi-eye', !isPassword);
    eyeIcon.classList.toggle('bi-eye-slash', isPassword);
    });
   //Swiper slidebar
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableonOnInteraction: false,
      }
    });

</script>
</body>
</html>