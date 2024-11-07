@extends('layouts.front')
@section('content')

<style>
 

.ripple-cursor {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: rgba(0, 150, 255, 0.5); /* Ripple color */
    pointer-events: none;
    z-index: 9999;
    transform: translate(-50%, -50%);
    transition: transform 0.2s ease, width 0.5s ease, height 0.5s ease;
}

.clicked {
    width: 100px;
    height: 100px;
    opacity: 0;
}

</style>

<div class="ripple-cursor"></div>

  <section id="hero" class="hero section dark-background">

  <!-- <img src="/frontend/assets/img/hero-bg.jpg" alt="" data-aos="fade-in"> -->

    <div id="hero-carousel" class="carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="container position-relative">

        <div class="carousel-item active">
          <div class="carousel-container">
            <h2>Welcome to Intelliai</h2>
            <p>Virtually knock 500 to 2,500 doors per day with IntelliAI, a leading SMS marketing agency. We specialize in virtual door-to-door campaigns that help businesses engage customers, increase leads, and boost revenue. Try our data-driven strategy with a free trial for those who qualify and see how SMS can transform your outreach.</p>
            <a href="#about" class="btn-get-started">Read More</a>
          </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
          <div class="carousel-container">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Virtually knock 500 to 2,500 doors per day with IntelliAI, a leading SMS marketing agency. We specialize in virtual door-to-door campaigns that help businesses engage customers, increase leads, and boost revenue. Try our data-driven strategy with a free trial for those who qualify and see how SMS can transform your outreach.</p>
            <a href="#about" class="btn-get-started">Read More</a>
          </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
          <div class="carousel-container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Virtually knock 500 to 2,500 doors per day with IntelliAI, a leading SMS marketing agency. We specialize in virtual door-to-door campaigns that help businesses engage customers, increase leads, and boost revenue. Try our data-driven strategy with a free trial for those who qualify and see how SMS can transform your outreach.</p>
            <a href="#about" class="btn-get-started">Read More</a>
          </div>
        </div><!-- End Carousel Item -->

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </div>

  </section><!-- /Hero Section -->

  <!-- Featured Services Section -->
  <section id="featured-services" class="featured-services section">

    <div class="container">

    <div class="row gy-4">
    @foreach ($services as $service)
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
                <div class="icon">
                    <img src="{{ $service->icon_url }}" alt="{{ $service->title }}" class="img-fluid">
                </div>
                <a href="{{ route('services.show', $service->id) }}" class="stretched-link">
                    <h3>{{ $service->title }}</h3>
                </a>
                <p>{{ $service->short_description }}</p>
            </div>
        </div>
    @endforeach
</div>



    </div>

  </section><!-- /Featured Services Section -->

  <!-- About Section -->
  <section id="about" class="about section light-background">

    <div class="container">

      <div class="row gy-4">
        <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
          <img src="/frontend/assets/img/about.jpg" class="img-fluid" alt="">
          <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
        </div>
        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
          <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
          </ul>
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
          </p>
        </div>
      </div>

    </div>

  </section><!-- /About Section -->

  <!-- Features Section -->
  <section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Features</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">
    @foreach ($features as $index => $feature)
        <div class="row gy-4 align-items-center features-item">
            @if ($index % 2 === 0) <!-- Even index: left aligned -->
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="{{ $index * 100 }}">
                    <img src="{{ $feature->image_path }}" class="img-fluid" alt="{{ $feature->title }}">
                </div>
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <h3>{{ $feature->title }}</h3>
                    <p class="fst-italic">{{ $feature->description }}</p>
                    <ul>
                        @foreach ($feature->list_items as $item)
                            <li>
                                <i class="bi bi-check"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else <!-- Odd index: right aligned -->
                <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <h3>{{ $feature->title }}</h3>
                    <p class="fst-italic">{{ $feature->description }}</p>
                    <ul>
                        @foreach ($feature->list_items as $item)
                            <li>
                                <i class="bi bi-check"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="{{ $index * 100 }}">
                    <img src="{{ $feature->image_path }}" class="img-fluid" alt="{{ $feature->title }}">
                </div>
            @endif
        </div><!-- Features Item -->
    @endforeach
</div>

  </section><!-- /Features Section -->

  <script>
    const rippleCursor = document.querySelector('.ripple-cursor');

document.addEventListener('mousemove', function(e) {
    rippleCursor.style.transform = `translate(${e.pageX}px, ${e.pageY}px)`;
});

document.addEventListener('click', function() {
    rippleCursor.classList.add('clicked');
    setTimeout(() => {
        rippleCursor.classList.remove('clicked');
    }, 500);
});

  </script>
@endsection