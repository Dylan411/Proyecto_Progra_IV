<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!----======== CSS ======== -->
    <link  type="text/css" media="screen, projection " rel="stylesheet" href="/Proyecto/View/style.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="script.js" ></script>
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
                    <span class="name"><?php 
                    if(isset($_SESSION['nombreUsuario'])){
                        echo $_SESSION['nombreUsuario'] ;
                    }else{
                        echo "Welcome";
                    }
                    
                    ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
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
                        <a href="#">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">My Acccount</span>
                        </a>
                    </li>
                    <?php 
                    if(isset($_SESSION['nombreUsuario'])){
                        if ($result["test"]["tipoUsuario"] == 'Admin') {
                            echo '<li class="nav-link">';
                            echo '<a href="#">';
                            echo "<i class='bx bx-data icon'></i>";
                            echo '<span class="text nav-text">Software</span>';
                            echo '</a>';
                            echo '</li>';
                            echo '<li class="nav-link">';
                            echo '<a href="#">';
                            echo "<i class='bx bx-user-check icon'></i>";
                            echo '<span class="text nav-text">User</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }else{
                        $result["test"]["tipoUsuario"] = "";
                    }
                    ?>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                <?php 
                    $status = "";
                    if(isset($_SESSION['nombreUsuario'])){
                        $status = "Log Out";
                        $function = "logout";
                    }else{
                        $status = "Sign In";
                        $function = "showLogin";
                    }
                    
                    ?>
                    <a href= <?php echo "index.php?c=SoftwareController&a=" . $function ?> >
                        <i onclick="togglePopup()" class='bx bx-log-out icon'></i>
                        <span onclick="togglePopup()" class="text nav-text"><?php echo $status;?></span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text">Tiki Store</div>
            <?php
                echo "<div class='content'>";
                echo "<img class= 'products' src='" . $data["software"]["imagen"] . "'>";
                echo "<h3>" . $data["software"]["nombre"] . "</h3>";
                echo "<button class='download'><a href='index.php?c=SoftwareController&a=showOneItem&id=" . $data["software"]["id"] . "'>Download</button>";
                echo "</div>";
            ?>
        </div>
    </section>
</body>
</html>
