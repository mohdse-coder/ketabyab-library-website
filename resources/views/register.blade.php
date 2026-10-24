<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ثبت نام</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="Register-page">


    <form action="{{ route('register.submit') }}" method="post" class="form-Register">
      @csrf
      <h1>ایجاد اکانت جدید</h1>
      <br>
      <input type="text" name="username" placeholder="نام کاربری" required>
      <input type="email" name="email" placeholder="ایمیل" style="direction: rtl;" required>
      <input type="password" name="password" placeholder="رمز عبور" required>
      <button type="submit" class="btn btn-primary">ثبت‌ نام</button>
    </form>

    @if(session('success'))
      <div class="bg-green-100 text-green-800 p-2 rounded mb-3 text-center">
        {{ session('success') }}
      </div>
    @endif
  </div>

</body>
</html>
