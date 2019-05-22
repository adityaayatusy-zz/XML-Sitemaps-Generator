<?php

// Author:aditya ayatusy

class Sitemap {

    public $url;
    public $rows = [];
    public $priority = [];
    public $key;
    public $external_url = false;
    public $img_url = false;
    public $directory;
    
    public function __construct($url,$dir = null){
        $this->url = $url;
        if(!$dir){
            $this->directory = $_SERVER['DOCUMENT_ROOT'];
        }else{
            $this->directory = $dir;
        }
    }

    public function create(){
        error_reporting(0);
        $this->key = 1;
        $this->node();
    
        foreach ($this->rows as $k) {
            $this->node($k);
            
        }
        $this->createFile($this->rows,$this->priority);
        return true;
    }
    
    public function node($data = ''){
        $html = new DOMDocument();
        $domain = $this->url;
        // load page
        if($data != ''){
            $html->loadHtmlFile($data);
        }else{
            $html->loadHtmlFile($domain);
        }

        $hasil = $html->getElementsByTagName('a');
        $image = $html->getElementsByTagName('img');
        
        $this->cond($hasil,$image,$domain);

        //priority 
        if($this->key >= 0.4){
            $this->key -= 0.2;
        }else{
            $this->key = 0.2;
        }
        
        return $this->rows;
    }

    public function cond($hasil,$image,$domain){
        
        foreach ($hasil as $i => $h) {
            if(!in_array($h->getattribute('href') ,$this->rows)){
                if($this->external_url == false){
                    if(strpos($h->getattribute('href'),$domain) === 0){
                        if(strpos($h->getattribute('href'),'#') !== 0){
                            $this->rows[] = $h->getattribute('href');
                            $this->priority[] = $this->key;
                        }
                    }
                }else{
                    if(strpos($h->getattribute('href'),'#') !== 0){
                        $this->rows[] = $h->getattribute('href');
                        $this->priority[] = $this->key;
                    }
                }
            }
            
        }

        if($this->img_url == true){
            foreach ($image as $im) {
                if(strpos($im->getattribute('src'),'/') === 0){
                    $this->rows[] = $domain.$im->getattribute('src');
                    $this->priority[] = 0.1;
                }
                
            }
        }
    }

    public function createFile($data,$prio){
        $myfile = fopen($this->directory."/sitemap.xml", "w") or die("Unable to open file!");
        $text = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\n\n\n";
        foreach ($data as $k => $d) {
            $text .= "
    <url>
        <loc>".$d."</loc>
        <lastmod>".Date('Y-m-d').'T'.date("H:i:s").'+00:00'."</lastmod>
        <priority>".$prio[$k]."</priority>
    </url>";
        }
    // 2019-02-03T10:28:15+00:00
        $text .= "\n\n".'</urlset>';
        fwrite($myfile, $text);
        fclose($myfile);

    }
}