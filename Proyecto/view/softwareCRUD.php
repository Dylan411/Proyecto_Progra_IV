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
                        <a href="#">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">My Acccount</span>
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
        <table class="styled-table-software">
            <thead>
                <tr>
                    <th class = "left">Id</th>
                    <th >Nombre</th>
                    <th >Descripcion</th>
                    <th >Idioma</th>
                    <th >Desarollador</th>
                    <th >Imagen</th>
                    <th >Año</th>
                    <th >Tamaño</th>
                    <th >Novedades</th>
                    <th >Categoria</th>
                    <th ></th>
                    <th class = "right"></th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <form action="index.php?c=SoftwareController&a=insertSoftware"  method="post">
                        <td contenteditable= 'false'>#</td>
                        <td><input type="text" name="nombre"  required></td>
                        <td><input type="text" name="descripcion" required></td>
                        <td><input type="text" name="idioma" required></td>
                        <td><input type="text" name="desarollador" required></td>
                        <td><input type="text" name="imagen" required></td>
                        <td><input type="text" name="anioCreacion" required></td>
                        <td><input type="text" name="tamanio" required></td>
                        <td><input type="text" name="novedades" required></td>
                        <td><input type="text" name="categoria" required></td>
                        <td>
                            <a><button>Insert</button></a>
                        </td>
                        </form>
                    </tr>
                    <form id="software"  method="post">
                    <?php
                        echo '<script>
                            function actionForm(formid, act){
                                document.getElementById(formid).action=act;
                                document.getElementById(formid).submit();
                            }
                        </script>';     

                    foreach ($data["software"] as $item){
                        echo "<tr>";
                        echo '
                            <td><input name="id['.$item["id"].']" value="'.$item["id"].'" /></td>
                            <td><input name="nombre['.$item["id"].']" value="'.$item["nombre"].'" /></td>
                            <td><input name="descripcion['.$item["id"].']" value="'.$item["descripcion"].'" /></td>
                            <td><input name="idioma['.$item["id"].']" value="'.$item["idioma"].'"/></td>
                            <td><input name="desarollador['.$item["id"].']" value="'.$item["desarollador"].'" /></td>
                            <td><input name="imagen['.$item["id"].']" value="'.$item["imagen"].'" /></td>
                            <td><input name="anioCreacion['.$item["id"].']" value="'.$item["anioCreacion"].'" /></td>
                            <td><input name="tamanio['.$item["id"].']" value="'.$item["tamanio"].'"/></td>
                            <td><input name="novedades['.$item["id"].']" value="'.$item["novedades"].'" /></td>
                            <td><input name="categoria['.$item["id"].']" value="'.$item["categoria"].'"/></td>
                        ';
                        echo "  <td>";
                        echo '<input type="button" value="Update" onClick="actionForm(this.form.id, \'index.php?c=SoftwareController&a=updateSoftware\')" />';
                        echo "  </td>";
                        echo "  <td>";
                        echo '<input type="button" value="Delete" onClick="actionForm(this.form.id, \'index.php?c=SoftwareController&a=deleteSoftware&id='.$item["id"].'\')" />';
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

