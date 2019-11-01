<?php
$dir = scandir(__DIR__);
$classes = array_filter($dir, function ($dir){
    return preg_match('/class\.php$/',$dir);
});
array_walk($classes, function ($class){
    require_once($class);
});