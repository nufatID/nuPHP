<?php

namespace App\Helper;

class SideMenuTab
{
    private static $pages;

    public static function render()
    {
        self::$pages = [
            // Common pages
            ['slug' => 'tabungan', 'name' => 'Tabungan', 'icon' => 'ni ni-spaceship text-primary', 'auth' => 'common', 'roles' => null],
            ['slug' => 'tabungan/transaksi', 'name' => 'Transaksi', 'icon' => 'ni ni-ui-04 text-blue', 'auth' => 'common', 'roles' => null],
            ['slug' => 'midtrans/pembayaran/tabungan', 'name' => 'UB-Tab Pay', 'icon' => 'ni ni-money-coins text-green', 'auth' => true, 'roles' => [0, 1]],
            ['slug' => 'pembayaran/kredit/tabungan', 'name' => 'Pembayaran', 'icon' => 'ni ni-money-coins text-green', 'auth' => true, 'roles' => [1]],
            ['slug' => 'pembayaran/debit/tabungan', 'name' => 'Pendebitan', 'icon' => 'ni ni-money-coins text-red', 'auth' => true, 'roles' => [1]],

        ];

        $isLoggedIn = self::isLogin();
        $currentUrl = self::getCurrentUrl();
        $result = '<ul class="navbar-nav mb-md-3">';

        foreach (self::$pages as $page) {
            if (
                ($isLoggedIn && $page['auth'] === true || !$isLoggedIn && $page['auth'] === false || $page['auth'] === 'common')
                && (is_null($page['roles']) || self::isRole($page['roles']))
            ) {
                $isActive = strpos($currentUrl, $page['slug']) !== false ? 'active' : '';
                $result .= '<li class="nav-item ' . $isActive . '">';
                $result .= '<a class="nav-link" href="' . getBaseUrl() . $page['slug'] . '">';
                $result .= '<i class="' . $page['icon'] . '"></i> ' . $page['name'] . '</a>';
                $result .= '</li>';
            }
        }

        $result .= '</ul>';
        return $result;
    }

    private static function isLogin()
    {
        return isset($_SESSION['login']);
    }

    private static function getCurrentUrl()
    {
        $currentUrl = $_SERVER['REQUEST_URI'];
        return trim($currentUrl, '/');
    }

    private static function isRole($roles)
    {
        if (isset($_SESSION['login_role'])) {
            if (is_array($roles)) {
                return in_array($_SESSION['login_role'], $roles);
            } else {
                return $_SESSION['login_role'] == $roles;
            }
        }
        return false;
    }
}
