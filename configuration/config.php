<?php
// 
session_name("OFI1061NAUTH");
session_start();

function base_url()
{
    return LINK_URL;
}

function site_url($url)
{
    return LINK_URL.$url;
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}