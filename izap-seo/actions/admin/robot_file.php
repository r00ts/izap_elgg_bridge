<?php

$file_path = elgg_get_root_path().'robots.txt';
$file_data = get_input('description');
$result = file_put_contents($file_path, $file_data);
