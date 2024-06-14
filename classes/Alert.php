<?php
class Alert
{
    public static function SetAlert($a, $b)
    {
        $_SESSION['alert'] = [
            'type' => $a,
            'pesan' => $b,
        ];
    }
    public static function show()
    {
        if (isset($_SESSION['alert'])) {
            echo '<div class="alert alert-' . $_SESSION['alert']['type'] . '" role="alert">' . $_SESSION['alert']['pesan'] . '</div>';
        }
        unset($_SESSION['alert']);
    }
}
