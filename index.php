<?php
include("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>What's the weather like?</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css" />
    
    </head>

<body>
<?php
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(0);
    $add_city = $_POST["city_add"];
    
    $string = "http://api.openweathermap.org/data/2.5/weather?q=".$add_city."&units=metric&appid=7f9bf45408aa31617553024e016fe264";
    $payload = file_get_contents($string);
    if($add_city){
        if(($payload)) {
            $data = json_decode(file_get_contents($string),true);
            $temp1 = $data['main']['temp'];
            $icon1 = $data['weather'][0]['icon'];
            $desc1 = $data['weather'][0]['description'];
            if(isset($_SESSION['queries']))
            {
                array_push($_SESSION['queries'],$_POST["city_add"]);
            }
            else
            {
                $_SESSION['queries']=[$_POST["city_add"]];
            }
        }
        else {
            echo "<script type='text/javascript'>alert('\"$add_city\" is not supported. Kindly provider another city.');</script>";
        }
    }
    
}
?>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Check the weather
                     </h1>
                     <a class="button is-info" href="logout.php" style:>
                                    Logout
                                </a>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-offset-4 is-4">
                    <form method="POST">
                            <div class='container1'>
                            
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input class="input" name="city_add" type="text" id='city_p' placeholder="City Name" required>
                            </div>
                            <div class="control">
                            <button class="button is-info" >
                                    Find City Temperature
                                </button>
                                </div>
                        </div>
                    </form>
                                
                            </div>

                </div>
            </div>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-offset-4 is-4">
                <?php
                   $str=[];
                    if(isset($_SESSION['queries']))
                    {
                        foreach($_SESSION['queries'] as $p)
                        {
                           array_push($str, $p);
                        }
                    }
                    $str1=array_merge($str,["Delhi","Bangalore","Mumbai","Hyderabad","Kolkata"]);
                   $str2=array_unique($str1);

                      foreach($str2 as $city)
                        {
                            
                            $string = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=4da85e50a9e8c8b0e38766bcdb4de4da";
                            $data = json_decode(file_get_contents($string),true);
                            $temp = $data['main']['temp'];
                            $icon = $data['weather'][0]['icon'];
                            $desc = $data['weather'][0]['description'];
                            $query="UPDATE CityTable Set temp='$temp' , icon='$icon' , Description='$desc' where city ='$city'";
                            $result=mysqli_query($con,$query);
                 ?>           
                    <div class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-50x50">
                                    <img src="http://openweathermap.org/img/w/<?php echo $icon?>.png" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <span class="title"><?php echo $city?></span>
                                        <br>
                                        <span class="subtitle"><?php echo $temp?> ° C</span>
                                        <br> <?php echo $desc?> 
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>                    
                 <?php
                        }                                                                                           
                  
                    
                 ?>
                </div>
            </div>
        </div>
        <div class="control">
                                
                            </div>
    </section>
    <footer class="footer">
    </footer>
</body>

</html>
