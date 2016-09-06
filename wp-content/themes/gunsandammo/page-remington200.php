<?php 

$user = "";
$pass = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
$user = $_POST['user'];
$pass = $_POST['pass'];
}

if($user == "remington" && $pass == "Bicentennial200@") {
    get_template_part('remington/index');
}
else {
    if(isset($_POST)) {?>

            <form method="POST" action="<?php echo htmlspecialchars(get_permalink()); ?>">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?php }
}
?>



