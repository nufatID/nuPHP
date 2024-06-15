<?php

namespace Nufat\Cli;

class View
{

    public function generate($pa = 'page', $pa1 = null)
    {
        $y = '<?php $this->extend("layout/layout.php"); ?>';
        file_put_contents('views/' . $pa . '.php', $y);
    }
    public function html($q)
    {
        $y = '<!doctype html>
                <html lang="id">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>nuPHP | ' . $q . '</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                </head>
                <body>
                    <h1>Hello, world!</h1>
                    <p>file ' . $q . '.php ini dibuat oleh nuPHP</p>
                      <p>Silahkan lanjutkan</p>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
                </body>
                </html>
                ';
        return $y;
    }
    public function layout($q)
    {

        return $y;
    }
    public function Index()
    {
        return Help::Index();
    }
}
