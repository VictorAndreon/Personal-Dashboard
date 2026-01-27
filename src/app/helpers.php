<?php

if (!function_exists('notify')) {
    function notify()
    {
        return flash()->use('theme.amazon');
    }
}