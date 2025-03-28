<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="id">

<head>
    <title><?php echo $__env->yieldContent('title', 'Default Title'); ?></title>
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
  <?php echo $__env->yieldContent('head'); ?>
</head>

<body>
  
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

   <?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\kas\templates/layouts/main.blade.php ENDPATH**/ ?>