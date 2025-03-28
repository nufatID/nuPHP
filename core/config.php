<?php
define('BASE_DIR', getenv('BASE_DIR'));

//database mysql koneksi
define('DB_HOST', getenv('DB_HOST'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));

//Auth System
define('AUTH', filter_var(getenv('AUTH'), FILTER_VALIDATE_BOOLEAN));

//Email System SMTP
define('SMTP_HOST', getenv('SMTP_HOST'));
define('EMAIL_NAMA', getenv('EMAIL_NAMA'));
define('EMAIL_ADR', getenv('EMAIL_ADR'));
define('EMAIL_PASS', getenv('EMAIL_PASS'));

//version
define('APP_VERSION', getenv('APP_VERSION'));
define('NUPHP', getenv('NUPHP'));
