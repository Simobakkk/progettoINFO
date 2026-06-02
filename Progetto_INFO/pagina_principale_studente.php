<?php
session_start();

$pi = $_SESSION["pi"] ?? null;
$studente = [];

if (isset($pi)) {
    $conn = new mysqli("localhost", "root", "", "GestioneFSL");
    
    if (!$conn->connect_error) {
        $pi_safe = $conn->real_escape_string($pi);
        $querySQL = "SELECT * FROM Studente WHERE PI = '$pi_safe'";
        $ris = $conn->query($querySQL);
        
        if ($ris && $ris->num_rows > 0) {
            $row = $ris->fetch_assoc();
            $studente = [
                "cf" => $row['CF_S'],
                "nome" => $row['nome'],
                "cognome" => $row['cognome'],
                "nascita" => $row['data_nascita'],
                "classe" => $row['classe'],
                "indirizzo" => $row['indirizzo_studi'],
                "tel" => $row['telefono'],
                "email" => $row['email'],
                "competenze" => $row['competenze'],
            ];
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    }
    if(isset($CF_TA) && isset($PI)){
        if(!empty($CF_TA) && !empty($PI)){
            $insert = "INSERT INTO Tutor_aziendale (CF_TA, PI, nome, cognome, inquadramento, competenze, esperienze, email, telefono)
            VALUES ('$CF_TA', '$PI', '$nome', 'cognome', 'inq', 'comp', 'esp', 'email', 'tel');";
            $conn ->query($insert);
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Il tuo account - Studente</title>
    <style>
        a{
            text-decoration: none;
            color:rgb(68, 184, 85);
        }
        .main-scritta{
            font-size: 35px;
            color: black;
            font-family: calibri;
            font-weight: bold;
        }
        .secondary-scritta{
            font-size: 15px;
            color: rgb(178, 178, 178);
            font-family: calibri;
            font-weight: bold;
        }
        .container_register{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            height: auto;
            width: 50%;
            padding: 40px 5px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        form{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-direction: column;
            width: 100%;
        }
        .label-wrapper{
            width: 70%;
            display: flex;
            align-items: center;
            justify-content: left;
            font-family: calibri;
            color: rgb(155, 155, 155);
        }
        input[type="text"], input[type="password"], input[type="email"]{
            cursor: pointer;
            width: 70%;
            height: 30px;
            background-color: white;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            font-family: calibri;
            border: 0px;
            padding: 10px 10px;
            transition: transform 0.2s ease-in-out;
        }
        input[type="text"]:hover, input[type="password"]:hover,  input[type="email"]:hover, input[type="submit"]:hover{
            transform: scale(1.04);
        }
        input[type="submit"]{
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            width: 70%;
            height: 40px;
            background-color:rgb(68, 184, 85);
            padding: 5px 20px;
            font-family: calibri;
            font-size: 18px;
            color: white;
            border-radius: 10px;
            border: 0px;
            transition: transform 0.2s ease-in-out;
        }
        .merger{
            padding: 0px 0px;
            display: flex;
            flex-direction: row;
            width: 70%;
        }
    </style>
</head>
<body style="background-color: white;">
    <nav>
        <div class="logo"><img src="Immagini/logoFSL.png" style="height: 90px; width: 90px;"></div>
        <div class="name" id="greeting"><h2 style="font-family: Inter; font-size: 15px; color: black;"></h2></div>
        <ul>
            <li><a href="homepage-gestionePCTO.php">Home</a></li>
            <li><a><?php 
                if(!empty($azienda)) {
                    echo htmlspecialchars($studente['nome']);
                } else {
                    echo "Utente non autenticato";
                }
                ?></a></li>
            <li><a href="FAQ.html">FAQ</a></li>
        </ul>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <main style="padding: 40px; font-family: Inter, sans-serif; max-width: 1000px; margin: 0 auto;">
        <?php if (!empty($studente)): ?>
            <div class="profile-card" style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <h2 style="margin-top: 0; color: #333;">Dati del Profilo</h2>
                <hr style="border: 0; height: 1px; background: #eee; margin-bottom: 20px;">

                <p style="font-size: 30px; font-weight: bold;"><?php echo htmlspecialchars($studente['nome']); ?></p>
                <p style="font-size: 30px; font-weight: bold;"><?php echo htmlspecialchars($studente['cognome']); ?></p>

                <p><strong>Responsabile:</strong> <?php echo htmlspecialchars($studente['data_nascita']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($studente['classe']); ?></p>
                <p><strong>Settore:</strong> <?php echo htmlspecialchars($studente['indirizzo_studi']); ?></p>
                <p><strong>ATECO:</strong> <?php echo htmlspecialchars($studente['telefono']); ?></p>
                <p><strong>Telefono:</strong> <?php echo htmlspecialchars($studente['email']); ?></p>
                <p><strong>Telefono:</strong> <?php echo htmlspecialchars($studente['competenze']); ?></p>
            </div>
        <?php else: ?>
            <p style="color: red; text-align: center;">Nessun dato trovato. Effettua il login.</p>
        <?php endif; ?>

        <?php
            // RECUPERO ATTIVITA
            $studenti_assegnati = [];
            if(!empty($azienda['PI'])){
                $conn = new mysqli("localhost", "root", "", "GestioneFSL");
                if (!$conn->connect_error) {

                    $query = "SELECT * FROM attivita;";
                    $ris = $conn -> query($query);

                    if($ris && $ris->num_rows > 0){
                        while($row = $ris->fetch_assoc()){
                            // Nota le parentesi quadre [] per aggiungere elementi alla lista
                            $attivita = [
                                "titolo"            => $row['titolo'],
                                "descrizione"       => $row['descrizione'],
                                "periodo_i"         => $row['periodo_i'],
                                "periodo_f"         => $row['periodo_f'],
                                "periodo"           => $row['periodo'],
                                "orario_i"          => $row['orario_i'],
                                "orario_f"          => $row['orario_f'],
                                "att_oggetto"       => $row['att_oggetto'],
                                "max_studenti"      => $row['max_studenti'],
                                "competenze_ric"    => $row['competenze_ric'],
                                "ambito"            => $row['ambito']
                            ];
                        }
                    }
                }
            }
        ?>

        <?php
            // RECUPERO ATTIVITA
            $studenti_assegnati = [];
            if(!empty($azienda['PI'])){
                $conn = new mysqli("localhost", "root", "", "GestioneFSL");
                if (!$conn->connect_error) {

                    $presente = false;
                    $query = "SELECT CF_S FROM Partecipa WHERE CF_S = ".$studente['cf'];
                    $ris = $conn -> query($query);
                    if($ris -> num_rows > 0){
                        $presente = true;
                        $query2 = "SELECT ragione_sociale, responsabile 
                        FROM Azienda 
                        WHERE PI in (
                            SELECT PI
                            FROM Attivita
                            WHERE titolo IN (
                                SELECT titolo
                                FROM Partecipa
                                WHERE CF_S = ".$studente['cf'].";";
                        $azienda = [];
                        $ris2 = $conn ->query($query2);
                        $row = $ris2 ->fetch_assoc();
                        $azienda = [
                            "rs" => $row['ragione_sociale'],
                            "resp" => $row['responsabile']
                        ];
                    }
                }
            }
        ?>

        <?php if ($presente == true): ?>
            <div class="profile-card" style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <h2 style="margin-top: 0; color: #333;">La tua azienda</h2>
                <hr style="border: 0; height: 1px; background: #eee; margin-bottom: 20px;">

                <p style="font-size: 30px; font-weight: bold;"><?php echo htmlspecialchars($azienda['ragione_sociale']); ?></p>
                <p style="font-size: 30px; font-weight: bold;"><?php echo htmlspecialchars($azienda['responsabile']); ?></p>
            </div>
            

            <div style="margin-top: 20px; text-align: center;">
                <button id="btnCommento" onclick="toggleCommento()" style="padding: 12px 24px; font-size: 16px; background-color: rgb(68, 184, 85); color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background 0.3s;">
                    Aggiungi commento
                </button>
            </div>

            <div id="commento" style="max-width: 480px; margin: 0 auto; padding: 24px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); font-family: system-ui, sans-serif;">

                <h2 style="font-size: 1.4rem; font-weight: 600; color: #1a1a1a; margin-bottom: 16px;">
                    Lascia un commento
                </h2>

                <form method="POST" style="display: flex; flex-direction: column; gap: 14px;">

                    <input type="text" name="nome" placeholder="Il tuo nome"
                        style="padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f9fafb;"
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='#ffffff';"
                        onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';">

                    <textarea name="commento" placeholder="Scrivi il tuo commento..."
                        style="padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; height: 120px; resize: vertical; outline: none; transition: 0.2s; background: #f9fafb;"
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='#ffffff';"
                        onblur="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb';"></textarea>

                    <button type="submit"
                        style="padding: 12px; background: #3b82f6; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: 0.2s;"
                        onmouseover="this.style.background='#2563eb';"
                        onmouseout="this.style.background='#3b82f6';">
                        Invia commento
                    </button>

                </form>

            </div>
        <?php else: ?>
            <div style="width: 100%; max-width: 600px; margin: 20px auto; padding: 20px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); font-family: system-ui, sans-serif;">

                <!-- TITOLO ATTIVITÀ -->
                <h2 style="font-size: 1.4rem; font-weight: 600; color: #1a1a1a; margin-bottom: 12px;">
                    <?php echo $attivita['titolo']; ?>
                </h2>

                <!-- DESCRIZIONE -->
                <p style="font-size: 0.95rem; color: #555; line-height: 1.5; margin-bottom: 14px;">
                    <?php echo $attivita['descrizione']; ?>
                </p>

                <!-- INFO ATTIVITÀ -->
                <div style="display: flex; flex-direction: column; gap: 6px; font-size: 0.9rem; color: #444; margin-bottom: 16px;">

                    <span><strong>Periodo:</strong> <?php echo $attivita['periodo_i']; ?> → <?php echo $attivita['periodo_f']; ?></span>
                    <span><strong>Durata:</strong> <?php echo $attivita['periodo']; ?> giorni</span>
                    <span><strong>Orario:</strong> <?php echo $attivita['orario_i']; ?> - <?php echo $attivita['orario_f']; ?></span>
                    <span><strong>Oggetto attività:</strong> <?php echo $attivita['att_oggetto']; ?></span>
                    <span><strong>Max studenti:</strong> <?php echo $attivita['max_studenti']; ?></span>
                    <span><strong>Competenze richieste:</strong> <?php echo $attivita['competenze_ric']; ?></span>
                    <span><strong>Ambito:</strong> <?php echo $attivita['ambito']; ?></span>

                </div>

                <!-- PULSANTE SCEGLI -->
                <form method="POST" action="scegli_attivita.php" style="margin-top: 10px;">
                    <input type="hidden" name="titolo" value="<?php echo $attivita['titolo']; ?>">
                    <button type="submit"
                        style="padding: 10px 18px; background: #3b82f6; color: white; border: none; border-radius: 8px; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: 0.2s;"
                        onmouseover="this.style.background='#2563eb';"
                        onmouseout="this.style.background='#3b82f6';">
                        Scegli
                    </button>
                </form>

            </div>

        <?php endif; ?>

    </main>

    <script>
    function toggleCommento() {
        var container = document.getElementById("commento");
        var btn = document.getElementById("btnCommento");
        
        if (container.style.display === "none") {
            container.style.display = "block";
            btn.textContent = "Aggiungi un commento";
            btn.style.backgroundColor = "#6c757d";
        } else {
            container.style.display = "none";
            btn.textContent = "Aggiungi un commento";
            btn.style.backgroundColor = "rgb(68, 184, 85)";
        }
    }
    </script>

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
        <center><p class="copy" style="font-family: calibri;">©Copyright easyFSL s.r.l management company 2026</p></center>
    </footer>
</body>
</html>