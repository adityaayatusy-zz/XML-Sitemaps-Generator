<?php
    //autoload
    require_once 'autoload.php';
    //timeout max 5 minutes
    set_time_limit (18000);

    $smp = new Sitemap('https://google.com',__DIR__);
    $smp->img_url = true;
    $smp->external_url = true;
    $smp->create();