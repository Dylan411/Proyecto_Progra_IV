<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type = "text/javascript" src="view/script.js"></script>
    <!----======== CSS ======== -->
    <link href="view/style.css"
      rel="stylesheet" type="text/css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Tiki Store</title>
</head>

<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/Proyecto/Images/logo.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name"><?php echo "Login" ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'>
                <script>side()</script>
            </i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php?c=SoftwareController&a=index">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text" >Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?c=GuideController&a=index">
                            <i class='bx bxs-file-pdf icon' style='color:#ffffff'  ></i>
                            <span class="text nav-text">Guides</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                <?php
                    $status = "";
                    if (isset($_SESSION['nombreUsuario'])) {
                        $status = "Log Out";
                        $function = "logout";
                    }else {
                        $status = "Sign In";
                        $function = "showLogin";
                    }

                ?>
                    <a href= <?php echo "index.php?c=UserController&a=" . $function ?> >
                        <i onclick="togglePopup()" class='bx bx-log-out icon'></i>
                        <span onclick="togglePopup()" class="text nav-text"><?php echo $status; ?></span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                    <span  class="switch">
                            <script>mode()</script>
                        </span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <div class="homeLogin">
        <div class="wrapper">
            <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div  class="form-container">
            <div class="slide-controls">
            <input  type="radio" name="slide" id="login" checked>
            <input  type="radio" name="slide" id="signup">
            <label  for="login" class="slide login" onclick = "login()">Login</label>
            <label  for="signup" class="slide signup"  >Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="index.php?c=UserController&a=checkLogin" method="POST" class="login">
                <div class="field">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <?php
                    if (isset($errorLogin)) {
                        echo $errorLogin;
                    }
                ?>
                <div class="pass-link"><a href="#">Forgot password?</a></div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                    </div>
                <div class="signup-link">Not a member? <a onclick = "login()">Signup now</a></div>
          </form>
          
          <form action="index.php?c=userController&a=signup" method="POST" class="login">
          <div class="field">
              <input type="text" name="userName" placeholder="Username" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email Address" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
            </div>
            <div class="field">
              <input type="password" name="pass1" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div class="field">
              <input type="password" name="pass2" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            </div>
            <?php
                    if (isset($errorSignup)) {
                        echo $errorSignup;
                    }
                ?>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>

    </div>
</body>
</html>
