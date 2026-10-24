<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>پنل ادمین</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-page">
  <div class="container-admin">
    <h1>پنل ادمین</h1>
    <h2>لیست کاربران</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="users-table">
      <thead>
        <tr>
          <th>شماره</th>
          <th>نام کاربری</th>
          <th>ایمیل</th>
          <th>تاریخ ثبت‌نام</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
              <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">حذف</button>
            </form>

            </td>
          </tr>
        @empty
          <tr><td colspan="5">هیچ کاربری یافت نشد</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
