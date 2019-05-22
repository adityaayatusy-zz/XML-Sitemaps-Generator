<?php
    require_once 'core/Sitemap.php';
    
    $smp = new Sitemap('https://google.com',__DIR__);
    $smp->img_url = true;
    $smp->external_url = false;
    $smp->create();