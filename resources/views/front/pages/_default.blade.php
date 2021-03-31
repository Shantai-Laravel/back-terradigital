@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="cke-page">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h3>{{ $page->translation->title }}</h3>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-md-auto posrelative">
                  <div class="nav-static" id="navStatic">
                  </div>
                </div>
                <div class="col-md-8 col-12">
                  <section class="cke-content" id="ckePage">
                    {!! $page->translation->body !!}
                  </section>
                  <section class="gallery">
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery1.jpeg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery2.jpg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery3.jpg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery4.jpeg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery1.jpeg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery2.jpg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery3.jpg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                      <div class="col-md-3 col-6">
                        <img
                          src="/images/gallery/gallery4.jpeg"
                          alt=""
                          data-toggle="modal"
                          data-target="#zoomModal"
                        />
                      </div>
                    </div>
                  </section>
                  <div class="modal" id="zoomModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modalContainer">
                          <div class="closeZoom" data-dismiss="modal">
                            <svg
                              width="16px"
                              height="16px"
                              viewBox="0 0 16 16"
                              version="1.1"
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                            >
                              <g
                                id="AnaPopova-Site"
                                stroke="none"
                                stroke-width="1"
                                fill="none"
                                fill-rule="evenodd"
                              >
                                <g
                                  id="Prod_One_375---Swipe"
                                  transform="translate(-19.000000, -118.000000)"
                                  fill="#FFFFFF"
                                  fill-rule="nonzero"
                                >
                                  <path
                                    d="M27.6226706,126.612626 L37.3985243,126.612631 C37.7323875,126.606822 38,126.334254 38,126.000017 C38,125.665781 37.732388,125.393213 37.3985247,125.387405 L27.6226711,125.3874 L27.6227094,115.602057 C27.6169068,115.267871 27.3446029,115 27.0106892,115 C26.6767755,115 26.4044715,115.267872 26.3986685,115.602058 L26.3986302,125.3874 L16.6227505,125.387369 C16.4015614,125.383521 16.1955089,125.499436 16.0837896,125.690561 C15.9720702,125.881686 15.9720701,126.118279 16.0837893,126.309404 C16.1955085,126.500529 16.4015609,126.616443 16.62275,126.612595 L26.3986297,126.612626 L26.3986173,136.397943 C26.4044199,136.732129 26.6767238,137 27.0106375,137 C27.3445512,137 27.6168552,136.732128 27.6226582,136.397942 L27.6226706,126.612626 Z"
                                    id="Shape-Copy-3"
                                    transform="translate(27.000000, 126.000000) rotate(-315.000000) translate(-27.000000, -126.000000) "
                                  ></path>
                                </g>
                              </g>
                            </svg>
                          </div>
                          <div class="zoomSlider">
                          <!-- <div class="item">
                                  <div class="videoContainer">
                                    <video id="myVideoNav" autoplay loop muted>
                                        <source src="img/LBV-files-4site/Exploatari-miniere/Carier-1 PRODANESTI/Video/IMG_0806.MOV" type="video/mp4" />
                                        Your browser does not support HTML5 video.
                                    </video>
                                  </div>
                                </div> -->
                          <div class="item">
                            <img src="img/dev/gallery/gallery1.jpeg" alt="" />
                          </div>
                          <div class="item">
                            <img src="img/dev/gallery/gallery2.jpg" alt="" />
                          </div>
                          <div class="item">
                            <img src="img/dev/gallery/gallery3.jpg" alt="" />
                          </div>
                          <div class="item">
                            <img src="img/dev/gallery/gallery4.jpeg" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</main>
@include('front.partials.footer')
@stop
