<?php

function tolink($url)
{
    header("Location: " . getBaseUrl() . $url);
    exit;
}
function to_url($url)
{
    // hapus token csrf saja
    unset($_SESSION['token_csrf']);
    header("Location: " . getBaseUrl() . $url);
    exit;
}

function get_url($url)
{
    // hapus token csrf saja

    return getBaseUrl() . $url;
}
function Component($component, $variables = [])
{
    $templateEngine = new \Nufat\Nutemplete\Template();
    echo $templateEngine->ComponentView($component, $variables);
}

function Components($file, $data = [])
{
    $theme = new \Nufat\Nutemplete\Render(__dir__ . '/../resource/components');
    echo $theme->render($file . '.nu.php', $data);
}
function last_form()
{
    $_SESSION['last_form'] = $_SERVER['REQUEST_URI'];
}
function get_last_form()
{
    return $_SESSION['last_form'];
}

function vPost(array $keys)
{
    foreach ($keys as $key) {
        if (empty($_POST[$key]) || $_POST[$key] === null) {
            to_url(get_last_form() . "?eror=nullelement");
            exit();
        }
    }
}

function getCurrentUrl()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $currentUrl = $protocol . '://' . $host . $requestUri;

    // Encode the URL
    return urlencode($currentUrl);
}
function decodeUrl($encodedUrl)
{
    return urldecode($encodedUrl);
}

function dateid($dateStr)
{
    $formatter = new IntlDateFormatter(
        'id_ID', // Locale
        IntlDateFormatter::LONG, // Date format
        IntlDateFormatter::NONE, // Time format
        'Asia/Jakarta', // Timezone
        IntlDateFormatter::GREGORIAN, // Calendar type
        'MMMM yyyy' // Pattern
    );

    // Convert date string to DateTime object
    $date = new DateTime($dateStr);

    // Format the date to "Bulan Tahun" in Indonesian
    return $formatter->format($date);
}

function isMobile()
{
    // List of mobile user agents
    $mobileAgents = [
        'Android', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile', 'Mobile',
        'BlackBerry', 'webOS', 'Windows Phone', 'Nokia', 'Palm', 'Kindle', 'Silk'
    ];

    // Check if the user agent matches any of the mobile agents
    foreach ($mobileAgents as $agent) {
        if (stripos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) {
            return true;
        }
    }

    return false;
}

// Usage example
