<?php

echo print_r(unserialize(base64_decode($argv[1])),true) . PHP_EOL;