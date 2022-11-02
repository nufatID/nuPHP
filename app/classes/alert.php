<?php
class Alert
{
    public static function error($c, $m)
    {
        $pass = '<div class="alert alert-' . $c . '" role="alert">' . $m . '</div>';
        return $pass;
    }
}
