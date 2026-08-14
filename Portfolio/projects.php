<?php

$title = "Projects";
$header = "My Projects";

?>

<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $title; ?></title>
    </head>

    <body>

        <header>

            <center>

                <font color="purple">
                    <h1>ALYANNA'S PORTFOLIO</h1>
                </font>

                <nav>
                    <a href="home.php">Home</a> |
                    <a href="projects.php">Projects</a> |
                    <a href="contact.php">Contact</a>
                </nav>

            </center>

        </header>

        <hr>

        <main>

            <center>

                <h2><?php echo $header; ?></h2>

                <font color="sky blue">
                    <h3>"Amari Hotel"</h3>
                </font>
                
                <img src="images/project_amari.png" 
                     alt="Amari Hotel Project" 
                     width="500">

                <p>
                    A hotel booking website designed with a clean and
                    user-friendly interface.
                </p>

                <font color="green">
                    <h3>"Aurelio Clothing"</h3>
                </font>

                <img src="images/project_aurelio.png" 
                     alt="Aurelio Clothing Project" 
                     width="500">

                <p>
                    A luxury clothing website designed with a simple,
                    elegant, and classy visual style.
                </p>

                <font color="lightgreen">
                    <h3>"Nutrio Health App"</h3>
                </font>

                <img src="images/project_nutrio.png" 
                     alt="Nutrio Health Project" 
                     width="500">

                <p>
                    A health and nutrition app designed to help users
                    manage their meals and maintain healthy habits.
                </p>

            </center>

        </main>

    </body>

</html>