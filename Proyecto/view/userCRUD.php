<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type = "text/javascript" src="view/script.js"></script>
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
                    <img src="/Proyecto/Images/logo.png" alt="">
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

    <section class="home">
        <div class="text">Tiki Store</div>
        <table class="styled-table-user">
            <thead>
                <tr>
                    <th class = "left">Nombre Usuario</th>
                    <th >Contraseña</th>
                    <th >Email</th>
                    <th >Tipo Usuario</th>
                    <th ></th>
                    <th class = "right"></th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <form action="index.php?c=UserController&a=insertUser"  method="post">
                        <td><input type="text" name="nombre"  required></td>
                        <td><input type="text" name="contrasenia" required></td>
                        <td><input type="text" name="email" required></td>
                        <td><input type="text" name="tipoUsuario" required></td>
                        <td>
                            <a><button>Insert</button></a>
                        </td>
                        </form>
                        
                    </tr>
                    <form id="user"  method="post">
                    <?php
                    echo '<script>
                    function actionForm(formid, act){
                        document.getElementById(formid).action=act;
                        document.getElementById(formid).submit();
                    }
                    </script>';
                    foreach ($data["user"] as $item){
                        echo "<tr>";
                        echo '
                            <td><input name="nombre['.$item["nombreUsuario"].']" value="'.$item["nombreUsuario"].'" /></td>
                            <td><input name="contrasenia['.$item["nombreUsuario"].']" value="'.$item["contrasenia"].'" /></td>
                            <td><input name="email['.$item["nombreUsuario"].']" value="'.$item["email"].'" /></td>
                            <td><input name="tipo['.$item["nombreUsuario"].']" value="'.$item["tipoUsuario"].'"/></td>
                        ';
                        echo "  <td>";
                        echo '<input type="button" value="Update" onClick="actionForm(this.form.id, \'index.php?c=UserController&a=updateUser\')" />';
                        echo "  </td>";
                        echo "  <td>";
                        echo '<input type="button" value="Delete" onClick="actionForm(this.form.id, \'index.php?c=UserController&a=deleteUser&id='.$item["nombreUsuario"].'\')" />';
                        echo "  </td>";
                        echo "</tr>";                       
                    }
                    ?>
                    </form>
            </tbody>

    </table>
    </section>
</body>
</html>
