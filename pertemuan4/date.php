<?php
date_default_timezone_set('UTC');
// date
// echo date("l, d M Y");

// time
// echo time();
// echo date("d M Y", time() - 60 * 60 * 24 * 100);

// mktime
// $b = 8;
// $a = 22;
// echo date("l", mktime(0, 0, 0, $b, $a, 1998));

// strtotime
// echo date("d", (strtotime("-48 hours")));


echo date('l') . '<br>';
// echo date_default_timezone_get();

// mengubah timezone
echo 'Default Timezone: ' . date('d-m-Y H:i:s') . '</br>';
date_default_timezone_set('Asia/Jakarta');
echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
