@extends('layout.header')
<body>
	<!-- header section start -->
	<div class="header_section">
        @foreach($tbl as $item)
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="/"><img src="/image/{{$item->logo}}"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

                    @csrf
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#home">{{$item->nav1}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#about">{{$item->nav2}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#product">{{$item->nav3}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#video">{{$item->nav4}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#remote">{{$item->nav5}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#contact">{{$item->nav6}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"><img src="/assets/images/search-icon.png"></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="/login">{{$item->nav7}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">{{$item->nav8}}</a>
                    </li>
                  </ul>
                </div>

        </nav>
        @endforeach
	</div>
	<!-- header section end -->
  <!-- banner section start  -->
  <div id="home" class="banner_section layout_padding">
    <div class="container">
      <div id="my_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
              @foreach($tbl as $item)
                <div class="row">
                  <div class="col-md-6">
                    <h1 class="video_text">{{$item->whiteTitle}}</h1>
                    <h1 class="controller_text">{{$item->blueTitle}}</h1>
                    <p class="banner_text">{{$item->description}}</p>
                    <div class="shop_bt"><a href="#">{{$item->btnTitle}}</a></div>
                  </div>
                  <div class="col-md-6">
                    <div class="image_1"><img src="/image/{{$item->sliderImage}}" ></div>
                  </div>
                 </div>
              @endforeach
          </div>
          <div class="carousel-item">
              @foreach($tbl as $item)
                  <div class="row">
                      <div class="col-md-6">
                          <h1 class="video_text">{{$item->whiteTitle2}}</h1>
                          <h1 class="controller_text">{{$item->blueTitle2}}</h1>
                          <p class="banner_text">{{$item->description2}}</p>
                          <div class="shop_bt"><a href="#">{{$item->btnTitle2}}</a></div>
                      </div>
                      <div class="col-md-6">
                          <div class="image_1"><img src="/image/{{$item->sliderImage2}}"></div>
                      </div>
                  </div>
              @endforeach
          </div>
          <div class="carousel-item">
              @foreach($tbl as $item)
                  <div class="row">
                      <div class="col-md-6">
                          <h1 class="video_text">{{$item->whiteTitle3}}</h1>
                          <h1 class="controller_text">{{$item->blueTitle3}}</h1>
                          <p class="banner_text">{{$item->description3}}</p>
                          <div class="shop_bt"><a href="#">{{$item->btnTitle3}}</a></div>
                      </div>
                      <div class="col-md-6">
                          <div class="image_1"><img src="/image/{{$item->sliderImage3}}"></div>
                      </div>
                  </div>
              @endforeach
          </div>
        </div>
        <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- banner section end -->
  <!-- about section start -->
  <div id="about" class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="image_2"><img src="/assets/images/img-2.png"></div>
        </div>
        <div class="col-md-6">
          <h1 class="about_text">ABOUT</h1>
          <p class="lorem_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
          <div class="shop_bt_2"><a href="#">Shop Now</a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- about section end -->
  <!-- product section start -->
  <div id="product" class="product_section layout_padding">
    <div class="container">
      <div class="product_text">Our <span style="color: #5ca0e9;">products</span></div>
      <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
      <div class="product_section_2">
        <div class="row">
          <div class="col-md-6">
            <div class="image_2"><img src="/assets/images/img-3.png"></div>
            <div class="price_text">Price $ <span style="color: #3a3a38;">200</span></div>
            <h1 class="game_text">Video Game</h1>
            <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
          </div>
          <div class="col-md-6">
            <div class="image_2"><img src="/assets/images/img-3.png"></div>
            <div class="price_text">Price $ <span style="color: #3a3a38;">300</span></div>
            <h1 class="game_text">Video Game</h1>
            <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
          </div>
        </div>
      </div>
      <div class="see_main">
        <div class="see_bt"><a href="#">See More</a></div>
      </div>
    </div>
  </div>
  <!-- product section end -->
  <!-- video section start -->
  <div id="video" class="video_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="video_text_2">3d video game</h1>
          <h1 class="controller_text_2">remoto control</h1>
          <p class="banner_text_2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
          <div class="shop_bt"><a href="#">Shop Now</a></div>
        </div>
        <div class="col-md-6">
          <div class="image_4"><img src="/assets/images/img-4.png"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- video section end -->
  <!-- testimonial section start -->
  <div id="remote" class="testimonial_section layout_padding">
    <div class="container">
      <h1 class="testimonial_text">Testimonial</h1>
      <p class="ipsum_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
      <div class="testimonial_section_2">
        <div class="box_main">
          <div class="quote_icon"><img src="/assets/images/quote-icon.png"></div>
          <p class="dolor_text"> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum </p>
          <div class="client_main">
            <div class="client_left">
              <div class="images_5"><img src="/assets/images/img-5.png"></div>
            </div>
            <div class="client_right">
              <h1 class="sandy_text">Sandy Delex</h1>
              <p class="sandy_text_1">Reprehenderit</p>
            </div>
          </div>
        </div>
      </div>
      <div class="see_main">
        <div class="see_bt"><a href="#">See More</a></div>
      </div>
    </div>
  </div>
  <!-- testimonial section end -->
  <!-- contact section start -->
  <div id="contact" class="contact_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="email_box">
                    <div class="input_main">
                       <div class="container">
                          <form action="/action_page.php">
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Name" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Email" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Phone Numbar" name="Email">
                            </div>
                            <div class="form-group">
                                <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                            </div>
                          </form>
                       </div>
                        <div class="main_bt"><a href="#">SEND</a></div>
                    </div>
                 </div>
        </div>
        <div class="col-md-6">
          <div class="image_6"><img src="/assets/images/img-6.png"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- contact section end -->
  <!-- footer section start -->
  <div class="section_footer ">
      <div class="container">
          <div class="footer_section_2">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <h2 class="account_text">About Us</h2>
                  <p class="ipsum_text_2">dolor sit amet, consectetur magna aliqua. Ut enim ad minim veniam, quisdotempor incididunt r</p>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <h2 class="account_text">Useful Link</h2>
                  <div class="useful_link">
                    <ul>
                      <li><a href="#">Video games</a></li>
                      <li><a href="#">Remote control</a></li>
                      <li><a href="#">3d controller</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                <h2 class="account_text">Contact Us</h2>
                <p class="ipsum_text_2">dolor sit amet, consectetur magna aliqua. quisdotempor incididunt ut e </p>
                </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <h2 class="account_text">Newsletter</h2>
            <input type="" class="email_text" placeholder="Enter Your Email" name="Enter Your Email">
            <button class="subscribr_bt">SUBSCRIBE</button>
          </div>
        </div>
      </div>
@extends('layout.footer')
