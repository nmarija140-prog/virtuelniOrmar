<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dodajSliku.css">
</head>
<body>
    <main class="ekran">
        <div class="gore">
            <div class="okvir">
                 <img class="silueta" src="slike/silueta.svg" alt="">
            </div>
        </div>

        <section class="opis">
            <img class="talas" src="slike/Vector4.svg" alt="">
            <div class="sadrzaj">
                <h1>Dodaj svoju sliku</h1>
                <p class="uputstvo">Stani uspravno, tako da se vidi cela figura. Odeća iz ormara će se slagati preko tvoje slike.</p>

                <ul class="saveti">
                    <li>
                    <img class="cekirano" src="slike/cekirano.svg" alt="">
                    Cela figura mora da bude u kadru
                    </li>
                    <li>
                    <img class="cekirano" src="slike/cekirano.svg" alt="">
                        Jednobojna pozadina i dobro osvetljenje
                    </li>
                    <li>
                    <img class="cekirano" src="slike/cekirano.svg" alt="">
                        Pozadina se uklanja automatski
                    </li>
                </ul>

                <button class="dugme" type="button" id="dugmeSlikaj">
                    <img class="kamera" src="slike/kamera.svg" alt="">
                    Slikaj
                </button>
                <button class="dugme sporedno" type="button" id="dugmeGalerija">
                    <img class="galerija" src="slike/galerija.svg" alt="">
                    Izaberi iz galerije
                </button>

                <input type="file" id="kamera" accept="image/*" capture="environment" hidden>
                <input type="file" id="galerija" accept="image/*" hidden>
            </div>
        </section>
    </main>

    <script src="js/dodaj-sliku.js"></script>
</body>
</html>