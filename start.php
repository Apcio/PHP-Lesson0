<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="..\biblioteki\jquery.js"></script>
        <script type="text/javascript">
            function pobierzZ3() {
                var elem = $("#zad3")[0].Value;
                $.ajax({
                            type: "POST",
                            url: "funkcje.php",
                            data: {
                                    zadanie: 'zadanie3_Uruchom',
                                    pesel: elem
                                  },
                            success: function(zwrot) {
                                document.getElementById("zad3_odp").innerHTML = zwrot;
                            }
                        }
                    )
            }
        </script>
    </head>
    <body>
        <p>
            1. Wprowadź tekst bezpośredno z PHP:
            <?php 
                echo 'Tekst przykładowy';
            ?>
        </p>
        <p>
            2. Wprowadź tekst warunkowy:
            <?php
                if ( (date("s") % 2) == 0):
                    echo "Sekundy parzyste";
                else:
                    echo "Sekundy nieparzyste";
                endif;
            ?>
        </p>
        <p>
            3. Pobierz datę z PESEL:
            <input type="text" id="zad3"><input type="button" value="Testuj" onclick="pobierzZ3()">
            <p id="zad3_odp"></p>
        </p>
    </body>
</html>
