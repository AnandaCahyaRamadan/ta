<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
   <link rel="stylesheet" href="css/style.css">
     <!-- Option 1: Include in HTML -->
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
     <!-- Scripts -->
    <title>Landing Page</title>
    <style>
       body {
        font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
          <section id="navbar">
            <nav class="navbar navbar-expand-lg bg-dark shadow-lg">
              <div class="container">
                <a class="navbar-brand" href="#"><img src="https://i.postimg.cc/MTcywB5V/AA.png" alt="" width="150px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fa fa-bars text-warning"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ps-2 me-4">
                    <li class="nav-item ">
                      <a class="nav-link {{ Request::is('#') ? 'active':'' }} text-white" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ Request::is('#products') ? 'active':'' }} text-white" href="#products">Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ Request::is('#about') ? 'active':'' }} text-white" href="#about">About</a>
                    </li>
                  </ul>
                    @if (Auth::user()->roles->role_name == 'admin')
                      <a href="/dashboard" class="btn btn-outline-warning"> Dashboard </a>
                    @else
                    <a href="/sliders" class="btn btn-outline-warning"> Sliders </a>
                    @endif
                  @guest
                  <a href="{{ route('login') }}" class="btn btn-outline-warning"><i class="fa fa-sign-in-alt"></i> Login </a>
                  @endguest
                </div>
              </div>

            </nav>
          </section>
            <section id="carousels">
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  @foreach ($sliders as $key => $slider)
                    @if ($slider->gambar)
                      @if ($slider->status == 'approved')
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" class="@if ($key == 0) active @endif"></button>
                      @endif
                    @endif
                  @endforeach
                </div>
                <div class="carousel-inner">
                  @foreach ($sliders as $key => $slider)
                    @if ($slider->gambar)
                      @if ($slider->status == 'approved')
                        <div class="carousel-item @if ($key == 0) active @endif">
                          <img src="{{ asset('storage/'. $slider->gambar) }}" class="d-block w-100" alt="Slider Image">
                          <div class="carousel-caption d-none d-md-block">
                            <h2>{{ $slider->title }}</h2>
                            <p>{{ $slider->deskripsi }}</p>
                          </div>
                        </div>
                      @endif
                    @endif
                  @endforeach 
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>            
        <section id="search">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-12 mb-2 pt-5">
                <h2 class="fw-bold text-warning"> Product</h2>
              </div>
              <div class="col-md-12 text-center mb-1">
                <form action="/search" method="get">
                  <div class="input-group mx-auto">
                    <div class="row g-4">
                      <div class="col-md-3">
                        <input type="search" name="search" id="search" class="form-control rounded " placeholder="Masukkan kategori, judul atau deskripsi" aria-label="Search"  aria-describedby="search-addon" />
                      </div>
                      <div class="col-md-3">
                        <input type="number" name="min_price" class="form-control rounded" placeholder="Harga minimal">
                      </div>
                      <div class="col-md-3">
                        <input type="number" name="max_price" class="form-control rounded" placeholder="Harga maksimal">
                      </div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-outline-warning w-100">Search</button>
                      </div>
                    </div>
                
                  </div>
                </form>
              
              </div>
            </div>
            @if (session('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
            @endif
          </div>
        </section>
        
        <section id="products">
          @if (count($products) > 0 && $products[0]['status'] === 'approved')
            <div class="container pt-4 pb-5">
                <div class="row g-4">
                  @foreach ($products as $key => $product)
                    @if ($product->status == 'approved')
                      <div class="col-12 col-sm-6 col-md-3">
                          <div class="card" style="width: 100%;">
                              <img class="card-img-top" src="{{ asset('storage/' . $product->gambar )}}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title my-1">{{ $product->nama_product }}</h5>
                                <small class="fs-xmall fw-bold bg-warning pe-2 ps-2 pb-1 pt-1 rounded">{{ $product->categories->category_name }}</small>
                                <p class="card-text my-1 text-warning text-bold">Rp. {{ $product->harga }}</p>
                                <small class="card-text">{{ $product->deskripsi }}</small>
                                <div class="mt-2">
                                  @for ($i = 1 ; $i <= $product->rating ; $i++)
                                  <i class="fa fa-star text-warning"></i>
                                  @endfor
                                  <span> {{ $product->rating }}/5</span>
                                </div>
                                <div class="mt-4">
                                  <a href="https://wa.me/6281999651534" class="btn btn-warning fw-bold" style="width:100%"><i class="fab fa-whatsapp"></i> Pesan Sekarang</a>
                                </div>
                              </div>
                          </div>
                      </div>
                    @endif
                  @endforeach
                </div>
            </div>
            @else
            <div class="container pt-2 pb-5">
              <p>Product Belum ditambahkan</p>
            </div>
            @endif
        </section>
        <section id="about">
            <!-- Footer -->
            <footer class="text-center text-lg-start bg-dark text-white">
                <div class="container text-center text-md-start mt-3">
                    <div class="row pt-5">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 ">
                        <h6 class="text-uppercase fw-bold mb-4">
                        <img src="https://i.postimg.cc/MTcywB5V/AA.png" alt="" width="60%">
                        </h6>
                        <p>Mimi Kitty adalah cat shop yang menjual berbagai macam kebutuhan kucing seperti makanan obat dll.</p>
                    </div>
   
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                        Product
                        </h6>
                        <p>
                        <a class="text-reset text-decoration-none">Makanan</a>
                        </p>
                        <p>
                        <a class="text-reset text-decoration-none">Obat</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                        </h6>
                        <p><a href="#home" class="text-reset text-decoration-none">Home</a></p>
                        <p><a href="#about" class="text-reset text-decoration-none">About</a></p>
                        <p><a href="#products" class="text-reset text-decoration-none">Products</a></p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fa fa-map"></i> Banyuwangi</p>
                        <p><i class="fa fa-envelope"></i> mimisarimi@gmail.com</p>
                        <p><i class="fa fa-phone"></i> 08199651534</p>
                    </div>
                    </div>
                </div>
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2023 Copyright:
                <a class="text-reset fw-bold" href="">Ananda Cahya Ramadan</a>
                </div>
            </footer>
            <!-- Footer -->
        </section>
</body>
</html>