<?php
session_start();
$prijava = "prijava.php";
require_once "konekcija.php";
$greska = "";
$uspeh = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"] ?? "");
    $lozinka = $_POST["lozinka"] ?? "";
    $potvrda = $_POST["potvrda"] ?? "";

    if (empty($email) || empty($lozinka) || empty($potvrda)) {
        $greska = "Popunite sva polja.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $greska = "Unesite ispravnu email adresu.";
    } elseif (strlen($lozinka) < 8) {
        $greska = "Lozinka mora imati najmanje 8 karaktera.";
    } elseif ($lozinka !== $potvrda) {
        $greska = "Lozinke se ne podudaraju.";
    } else {
        $sql = "SELECT id FROM korisnici WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            $greska = "Korisnik sa ovom email adresom već postoji.";
        } else {
            $hashLozinke = password_hash($lozinka, PASSWORD_DEFAULT);
            $sql = "INSERT INTO korisnici (email, lozinka) VALUES (?, ?)";
            $stmtInsert = $connection->prepare($sql);
            $stmtInsert->bind_param("ss", $email, $hashLozinke);
            if ($stmtInsert->execute()) {
            $uspeh = "Vaš nalog je napravljen. Preusmeravamo vas na prijavu...";
            $email = "";
            header("Refresh: 3.5; url=" . $prijava);
            } else {
                $greska = "Došlo je do greške prilikom registracije.";
            }
            $stmtInsert->close();
        }

        $stmt->close();
    }
} ?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/registracija.css">
</head>
<body>
    <main class="ekran">
        <section class="opis">
            <img class="talas" src="slike/Vector3.svg" alt="">
            <form class="sadrzaj" id="formaRegistracija" method="POST" novalidate>
                <h1>Registracija</h1>

                <div class="polje">
                    <label for="email">Email</label>
                    <div class="unos">
                        <img src="slike/EnvelopeEmail.svg" alt="">
                        <input type="email" name="email" id="email" placeholder="Unesite email adresu"
                         value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                </div>

                <div class="polje">
                    <label for="lozinka">Lozinka</label>
                    <div class="unos">
                        <img src="slike/KljucSifra.svg" alt="">
                        <input type="password" name="lozinka" id="lozinka" placeholder="Unesite lozinku">
                        <button class="oko" type="button" data-za="lozinka" aria-label="Prikaži lozinku">
                            <img class="oko" src="slike/oko.svg" alt="">
                        </button>
                    </div>
                </div>

                <div class="polje">
                    <label for="potvrda">Potvrda lozinke</label>
                    <div class="unos">
                        <img src="slike/KljucSifra.svg" alt="">
                        <input type="password" name="potvrda" id="potvrda" placeholder="Potvrdite lozinku">
                        <button class="oko" type="button" data-za="potvrda" aria-label="Prikaži lozinku">
                            <img class="oko" src="slike/oko.svg" alt="">
                        </button>
                    </div>
                </div>
                 <?php if (!empty($greska)): ?>
                    <p class="greska" id="greska" role="alert">
                        <?php echo htmlspecialchars($greska, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                <?php elseif (!empty($uspeh)): ?>
                    <p class="uspeh" role="status">
                        <?php echo htmlspecialchars($uspeh, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                <?php else: ?>

                <p class="greska" id="greska" role="alert" hidden></p>
                 <?php endif; ?>
                <button class="dugme" type="submit" id="dugmeRegistracija">Napravi nalog</button>
                <p class="registracija">Već imate nalog? <a href="prijava.php">Prijavite se</a></p>
            </form>
        </section>
    </main>
    <script>
    document.querySelectorAll(".oko").forEach(dugme => {
        dugme.addEventListener("click", function() {

            const idPolja = this.dataset.za;
            const polje = document.getElementById(idPolja);

            polje.type = polje.type === "password" ? "text" : "password";

        });
    });
</script>
</body>
</html>