<html>

<head>
    <title>Registrasi Akun</title>
</head>

<body>
    <h1>Selamat datang di Program {{ env('CONFIG_NAME_APPLICATION') }}</h1>

    Password untuk loginmu adalah <h4>{{ $data['password'] }}</h4>
    <p>Mohon untuk tidak di bagikan kepada siapapun. email anda telah didaftarkan untuk mendaftarkan program kami. Harap
        abaikan bila bukan anda</p>

    Thanks,<br>
    {{ env('CONFIG_NAME_SCHOOL') }}

</body>

</html>
