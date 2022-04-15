<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="view/script.js"></script>
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="view/style.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Tiki Store</title>
</head>

<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/Git/Proyecto/Images/logo.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name"><?php 
                    if(isset($_SESSION['nombreUsuario'])){
                        echo $_SESSION['nombreUsuario'];
                    }else{
                        echo "Welcome";
                    }
                    ?> </span>
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
                    <input id = "search" type="text"  placeholder="Search...">
                    <script>
                            var input = document.getElementById('search');
                            input.addEventListener('keyup', function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                window.location = "index.php?c=SoftwareController&a=searchSoftware&id=" + input.value;
                            }
                            });
                        </script>
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
                    <?php 
                    if(isset($_SESSION['nombreUsuario'])){
                        if ($result["Role"]["tipoUsuario"] == 'Admin') {
                            echo '<li class="nav-link">';
                            echo '<a href="index.php?c=SoftwareController&a=softwareCRUD">';
                            echo "<i class='bx bx-data icon'></i>";
                            echo '<span class="text nav-text">Software</span>';
                            echo '</a>';
                            echo '</li>';
                            echo '<li class="nav-link">';
                            echo '<a href="index.php?c=UserController&a=userCRUD">';
                            echo "<i class='bx bx-user-check icon'></i>";
                            echo '<span class="text nav-text">User</span>';
                            echo '</a>';
                            echo '</li>';
                            echo '<li class="nav-link">';
                            echo '<a href="index.php?c=GuideController&a=guideCRUD">';
                            echo "<i class='bx bx-user-check icon'></i>";
                            echo '<span class="text nav-text">GuideCRUD</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }else{
                        $result["Role"]["tipoUsuario"] = "";
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
                    <a href= <?php echo "index.php?c=UserController&a=" . $function ?> >
                        <i onclick="togglePopup()" class='bx bx-log-out icon'></i>
                        <span onclick="togglePopup()" class="text nav-text"><?php echo $status;?></span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode
                    </span>
                    <div  class="toggle-switch" >
                        <span class="switch" id="switch">
                        <script >mode()</script>
                        </span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text">Tiki Store</div>
        <div class="gallery">
            <?php
                foreach ($data["software"] as $item) {
                    echo "<div class='content'>";
                    echo "<img class= 'products' src='" . $item["imagen"] . "'>";
                    echo "<h3>" . $item["nombre"] . "</h3>";
                    echo "<button class='download'><a href='index.php?c=SoftwareController&a=showOneItem&id=".$item["id"]."'>Download</button>";
                    echo "</div>";
                }
            ?>
            </div>
        </div>
    </section>

    
</body>
</html>


