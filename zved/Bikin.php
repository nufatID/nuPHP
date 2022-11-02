<?php
class Bikin
{
    public function Index($pa = 'page', $pa1 = null, $pa2 = null,)
    {
        $html = file_get_contents($pa1);
        file_put_contents('views/' . $pa . ".php", $html);
    }
}
