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
                  <otion value="3">Three</otion>
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

    <!-- OUR Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Phòng</h2>
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

    <!-- OUR FACILITIES -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">CƠ SỞ</h2>
    <div class="contrainer">
        <div class="row justify-content-evenly px-lg-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/Wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/air.svg" width="80px">
                <h5 class="mt-3">Máy Lạnh</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/raidio.svg" width="80px">
                <h5 class="mt-3">Radio</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/SPA.svg" width="80px">
                <h5 class="mt-3">Spq</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/TV.svg" width="80px">
                <h5 class="mt-3">TV</h5>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-4">
            <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
        </div>
    </div>

    <!-- OUR Feedback -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Feedbacks</h2>
    <div class="contrainer mt-5">
        <!-- Swiper Feedback-->
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5" >
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex algin-item-center p-4">
                        <img src="images/facilities/star.jpg" width="30px">
                        <h6 class="m-1 ms-2">Random user1</h6>
                    </div>
                    <p>
                        Bản thân chúng tôi mong muốn có trải nghiệm tuyệt vời và
                        những khoảng thời gian tuyệt vời đã là sự thành công rất lớn.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex algin-item-center p-4">
                        <img src="images/facilities/star.jpg" width="30px">
                        <h6 class="m-1 ms-2">Random user2</h6>
                    </div>
                    <p>
                       Amazing Good Job Em
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex algin-item-center p-4">
                        <img src="images/facilities/star.jpg" width="30px">
                        <h6 class="m-1 ms-2">Random user3</h6>
                    </div>
                    <p>
                        Trời ơi có cái hotel gì mà xịn thế nào, phải kiểm tra mới được
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-4">
            <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Feedbacks>>></a>
        </div>
    </div>

    <!-- Reach us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Liên hệ</h2>
    <div class="contrainer">
        <div class="row">
            <!-- Map -->
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100" height="320px" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56453.162935122054!2d109.13825128198059!3d12.253457263750047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067de00952ab5%3A0x3a2caca4f28a4c62!2sComodo%20Nha%20Trang%20Hotel!5e1!3m2!1svi!2s!4v1730276218078!5m2!1svi!2s" ></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <!-- Phone Number -->
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Hotline</h5>
                    <a href="tel: +849057768899" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+84 9057768899
                    </a>
                    <br>
                    <a href="tel: +849057768899" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +84 8567842167
                    </a>
                </div>
                <!-- Platform -->
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow us</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="contrainer-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3">Comodo Nha Trang Hotel</h3>
                <p>
                    Hotel Comodo là một điểm đến lý tưởng cho du khách, nổi tiếng với không gian sang trọng,
                    dịch vụ chuyên nghiệp và tiện nghi hiện đại. Với vị trí thuận lợi, gần các điểm du lịch nổi tiếng và trung tâm thương mại,
                    Comodo mang đến cho khách hàng trải nghiệm lưu trú tuyệt vời.
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a> <br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a> <br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow us</h5>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-twitter-x"></i> Twitter
                </a><br>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-facebook"></i> Facebook
                </a><br>
                <a href="#" class="d-inline-block text-dark text-decoration-none">
                    <i class="bi bi-instagram"></i> Instagram
                </a><br>
            </div>
        </div>
    </div>

    <h6 class="text-center bg-dark text-white p-3 m-0">Design and Devoloped by CEO GROUP</h6>
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
    //Swiper slidebar  coverflow
    var swiper = new Swiper(".swiper-testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        }
    });

</script>
</body>
</html>