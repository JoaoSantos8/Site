<?php 

    include_once ("php/frontOffice.php");
    global $con;

    session_start();

    if (!isset($_SESSION['utilizadorId'])) {
        header('Location: login.php');
        exit;
    }

    drawTopFO();
    ?>
        <style>
            body{
                background-image: url("images/fundoPacotes.jpg");
            }

        </style>
    <?php
    navBarPacote();
    pacotesCima();
    pacotes();
    navBarBottomFO();
    drawBottomFO();
?>