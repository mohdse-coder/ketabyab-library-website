<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>کتاب یاب</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
  <br>
  <header>
    <img src="https://img.icons8.com/?size=100&id=jw2ihM2uHfwE&format=png&color=000000" alt="library" width="60" height="60">
    <h1 class="h1-class"><b>سایت کتاب یاب</b></h1>
<div class="header">


        <form class="search" method="GET" action="{{ route('search') }}">
    <input type="text" class="search1" name="search" placeholder="نام کتاب را وارد کنید...">
    <button type="submit" class="search" name="search-btn">جستجو</button>
</form>



    <nav class="navbar ">
        <ul class="navbar-nav">
            <div class="header-right">
            <a class="nav-link" href="{{ route('login') }}">ورود</a>
            <a class="nav-link" href="{{ route('register.form') }}">ثبت نام</a>
            


      </ul>
    </div>

</div>
<script>
function toggleDropdown() {
    var menu = document.getElementById("adminMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>

  </div>
</nav>

  </header>

  <!-- افزودن کتابخانه -->
  <section class="add-library">
    <h2 class="addlibrary">افزودن کتابخانه جدید</h2>
    <p>در این بخش می‌توانید کتابخانه جدید خود را در سامانه ثبت و معرفی کنید. با وارد کردن اطلاعات دقیق مانند نام کتابخانه، آدرس، مشخصات مسئول و امکانات موجود، کاربران قادر خواهند بود کتابخانه شما را در میان نتایج جستجو مشاهده کنند. ثبت کتابخانه به سامانه کمک می‌کند تا منابع و کتاب‌های بیشتری در دسترس کاربران قرار گیرد و فرآیند جستجو و یافتن کتاب‌ها سریع‌تر و ساده‌تر انجام شود. همچنین با افزودن کتابخانه، امکان مدیریت بهتر منابع و به‌روزرسانی اطلاعات برای شما فراهم خواهد شد. لطفاً فرم زیر را با دقت تکمیل کنید تا کتابخانه شما با موفقیت به سیستم اضافه شود.</p>
    <a href="{{ route('register.form') }}" class="information-library">
  ثبت کتابخانه جدید
</a>


  </section>

  <!-- جستجوی کتاب -->
  <section class="search-section">
    <h2>نمایش بزرگترین کتابخانه ها</h2>


<div id="carouselExampleCaptions" class="carousel slide carousel-custom">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <section class="search-section">


    @if($topLibraries->isEmpty())
        <p style="text-align:center; margin-top:20px;">
            هیچ کتابخانه‌ای وجود ندارد.
        </p>
    @else
        <div id="carouselExampleCaptions" class="carousel slide carousel-custom">

            <div class="carousel-indicators">
                @foreach($topLibraries as $index => $library)
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach($topLibraries as $index => $library)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">

                        {{-- تصویر --}}
                        @if($library->cover)
                            <img src="{{ asset('storage/' . $library->cover) }}"
                                 class="d-block w-100"
                                 style="height:400px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/4809403.jpg') }}"
                                 class="d-block w-100"
                                 style="height:400px; object-fit:cover;">
                        @endif

                        {{-- توضیحات --}}
                        <div class="carousel-caption d-none d-md-block">
                            <h5><b>{{ $library->name }}</b></h5>
                            <p>
                                {{ $library->description ?? 'بدون توضیحات' }}
                            </p>
                            <p>
                                📚 تعداد کتاب‌ها: {{ $library->books_count }}
                            </p>

                            <a href="{{ route('libraries.show', $library->id) }}"
                               class="btn btn-light">
                                مشاهده کتاب‌ها
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    @endif
</section>

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


  <a id="foteer" href="{{ url('/call_us') }}" target="_blank"> تماس با ما</a>
  <a id="foteer" href="{{ url('/about') }}" target="_blank"> درباره ما</a>
  <a id="foteer" href="{{ url('/gavanin') }}" target="_blank">قوانین</a>
  <a id="foteer" href="{{ url('/your_Question') }}" target="_blank">سوالات متداول</a>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>
