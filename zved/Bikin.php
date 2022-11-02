<?php
class Bikin
{
    public function Index($pa = 'page', $pa1 = null, $pa2 = null)
    {
        $html = ($pa2) ?  $this->$pa1() : file_get_contents($pa1);
        file_put_contents('views/' . $pa . '.php', $html);

        $y = '---------------------------------------------------' . "\n";
        $y .= 'views/' . $pa . '.php --> telah dibuat.' . "\n";
        $y .= 'php nu serve dan lihat di http://localhost:8005/' . $pa . '   ---<' . "\n";
        $y .= '---------------------------------------------------' . "\n";
        return $y;
    }
    public function html()
    {
        $y = '<!doctype html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>nuPHP demo</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                </head>
                <body>
                    <h1>Hello, world!</h1>
                    <p>file ini dibuat oleh nuPHP</p>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
                </body>
                </html>
                ';
        return $y;
    }
}
