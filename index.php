<?php
    //autoload
    require_once 'autoload.php';
    //timeout max 5 minutes
    set_time_limit (18000);
    if(isset($_GET['submit'])){
        $smp = new Sitemap($_GET['url'],__DIR__);
        if(isset($_GET['ex'])){
            $smp->external_url = true;
        }
        if(isset($_GET['im'])){
            $smp->img_url = true;
        }
        $smp->create();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sitemap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body{
            margin:0px;
            padding:0px;
            text-align:center;
        }
        h1{
            color:#eaeaea;
            font-size:40px;
        }
        form{
            display:inline-block;
            position:absolute!important;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
        }
        input[type=checkbox]{
            text-align:justify;
        }
    </style>
</head>
<body>
    <form method="get" class="align-self-center">
    <h1>SITEMAP GENERATOR</h1>
        <div class="form-group">
            <input type="text" class="form-control" name="url" placeholder="http://Domain.com">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="ex" name="ex" id=""> <label></label>
            <label class="form-check-label" for="ex">
                External Url
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="im" name="im" id=""> <label></label>
            <label class="form-check-label" for="im">
                Image Url
            </label>
        </div>
        <button type="submit" class="btn btn-outline-primary" name="submit">Create Sitemap</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>