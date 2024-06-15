<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>@yield('title', 'Default Title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= getBaseUrl(); ?>assets/favicon.ico">

    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= getBaseUrl(); ?>assets/css/bootstrap.min.css">
    <!-- Plugins CSS -->

    <link id="theme-style" rel="stylesheet" href="<?= getBaseUrl(); ?>assets/css/styles.css">
  @yield('head')
</head>

<body>
  
    <main>
        @yield('content')
    </main>

   @include('partial.footer')
</body>
</html>
