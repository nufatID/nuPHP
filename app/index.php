<?php

function tolink($url)
{
    header("Location: " . getBaseUrl() . $url);
    exit;
}
