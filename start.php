<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="..\biblioteki\jquery.js"></script>
        <script type="text/javascript">
            function pobierzZ3() {
                var elem = $("#zad3")[0].value;
                $.ajax({
                            type: "POST",
                            url: "funkcje.php",
                            data: {
                                    zadanie: 'zadanie3_Uruchom',
                                    pesel: elem
                                  },
                            dataType: "JSON",
                            success: function(zwrot) {
                                document.getElementById("zad3_a").innerHTML = zwrot.a;
                                document.getElementById("zad3_b").innerHTML = zwrot.b;
                                if (zwrot.c === false) {
                                    zwrot.c = 'Nie można odczytać daty z PESELu';
                                }
                                else {
                                    zwrot.c = new Date(zwrot.c.date);
                                    zwrot.c = zwrot.c.toLocaleDateString();
                                }
                                document.getElementById("zad3_c").innerHTML = zwrot.c;
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
            3. Test PESEL:
            <input type="number" id="zad3"><input type="button" value="Testuj" onclick="pobierzZ3()">
            <p style="text-indent: 20px">a: Poprawność PESEL: <span id="zad3_a"></span></p>
            <p style="text-indent: 20px">b: Płeć: <span id="zad3_b"></span></p>
            <p style="text-indent: 20px">c: Data: <span id="zad3_c"></span></p>
        </p>
        <p>
            4. Połącz VSC z GITem.
        </p>
    </body>
</html>
