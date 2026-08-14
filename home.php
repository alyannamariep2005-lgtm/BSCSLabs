<?php

$title = "Home";
$header = "Welcome to My Portfolio";

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

                <img src="images/profile.jpg" 
                     alt="A photo of me" 
                     width="200">

                <p>
                    Hi! I'm Alyanna Marie, a 3rd year Computer Science student
                    at University of St. La Salle - Bacolod. I enjoy creating
                    creative and user-friendly digital experiences while
                    continuously learning new skills in technology. Through my
                    projects, I hope to use my passion for UI / UX Design and
                    interest in Web Development to create meaningful and
                    functional solutions.
                </p>

            </center>

        </main>

    </body>

</html>