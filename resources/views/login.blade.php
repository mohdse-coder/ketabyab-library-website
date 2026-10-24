<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>صفحه ورود</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-page">

    @if($errors->has('login_error'))
        <div style="color:red; text-align:center;">{{ $errors->first('login_error') }}</div>
    @endif

    @if(session('success'))
        <div style="color:green; text-align:center;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="post" class="form-login">
        @csrf
        <h1>ورود کاربر</h1>
        <br>
        <input class="email" type="email" name="email" placeholder="ایمیل" style="direction: rtl;" required>
        <input class="username" type="text" name="username" placeholder="نام کاربری" required>
        <input class="password" type="password" name="password" placeholder="رمز عبور" required>
        <a href="#"><p>فراموشی رمز عبور</p></a>
        <button type="submit">ورود</button>
        <a href="{{ route('register.form') }}"><p>ساخت حساب کاربری جدید</p></a>
    </form>

</body>
</html>
