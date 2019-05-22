<?php
    require_once 'core/Sitemap.php';


    $smp = new Sitemap('https://scnewbeta.000webhostapp.com',__DIR__);
    $smp->create()