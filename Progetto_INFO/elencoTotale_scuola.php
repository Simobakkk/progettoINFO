<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_pagine_principali.css?v=<?php echo time(); ?>">
    <title>La tua scuola - Referente</title>
</head>
<body>
    //navbar copiata da homepage
    <nav>
        <div class="logo"><img src="Immagini/logoFSL.png" style="height: 90px; width: 90px;"></div>
        <div class="name" id="greeting"><h2 style="font-family: Inter; font-size: 15px; color: black;"></h2></div>
        <ul>
            <li><a href="">Home</a></li>
            <li><a onclick="document.getElementById('sezionePrincipale').scrollIntoView({behavior: 'smooth'});">Account</a></li>
            <li><a href="FAQ.html">FAQ</a></li>
        </ul>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="top-div">

    </div>

    <footer class="footer">
        <div class="container">
            <div class="col">
                <h3>Azienda</h3>
                <a href="#sezionePrincipale.html">Prodotti</a>
                <a href="FAQ.html">FAQ</a>
                <a href="#">Lavora con noi</a>
            </div>
            <div class="col">
                <h3>Supporto</h3>
                <a href="#">FAQ</a>
                <a href="#">Assistenza</a>
                <a href="#">Privacy</a>
            </div>
            <div class="col">
                <h3>Social</h3>
                <a href="#">Instagram</a>
                <a href="#">LinkedIn</a>
                <a href="#">GitHub</a>
            </div>
        </div>
        <p class="copy" style="font-family: calibri;">©Copyright easyFSL s.r.l management company 2025</p>
    </footer>
</body>
</html>