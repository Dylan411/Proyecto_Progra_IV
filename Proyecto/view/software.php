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

    <div class="popup" id="popup-1">
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">
                ×</div>
            <h1>Sign in</h1>
            <div class="input-field"><input placeholder="Email" class="validate"></div>
            <div class="input-field"><input placeholder="Password" class="validate"></div>
            <div class="input-field">
                <select>
                    <option>Admin</option>
                    <option>User</option>
                </select>
                <i></i>
            </div>
            <button class="second-button">Sign in</button>
            <p>Don't have an account? <a href="/signup.html">Sign Up</a></p>
        </div>
    </div>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/Proyecto/Images/logo.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">UserName</span>
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
                        <a href="/Git/Proyecto/index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i onclick="togglePopup()" class='bx bx-log-out icon'></i>
                        <span onclick="togglePopup()" class="text nav-text">Sign In</span>
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
<script>
  function togglePopup() {
            document.getElementById("popup-1")
                .classList.toggle("active");
        }
</script>