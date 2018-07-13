<?php
function pobierzPlecZPESEL($p) {
    
    if (strlen($p) < 10) {
        return 'Nie zgadza się liczba znaków w PESELu';
    }

    if ($p[9] % 2 == 0) {
        return 'kobieta';
    }
    else {
        return 'mężczyzna';
    }
}

function weryfikujDateZPesel($p) {
    //upewniam się, że długość tekstu to przynajmniej 6 znaków
    if (strlen($p) < 6) {
        return false;
    }

    $rok = substr($p, 0, 2);
    $mc = substr($p, 2, 2);
    $dz = substr($p, 4, 2);

    if ( (!ctype_digit($rok)) OR (!ctype_digit($mc)) OR (!ctype_digit($dz)) ) {
        return false;
    }

    if ($mc > 80) {
        $rok = 1800 + $rok;
        $mc = $mc - 80;
    }
    else if ($mc > 60) {
        $rok = 2200 + $rok;
        $mc = $mc - 60;
    }
    else if ($mc > 40) {
        $rok = 2100 + $rok;
        $mc = $mc - 40;
    }
    else if ($mc > 20) {
        $rok = 2000 + $rok;
        $mc = $mc - 20;
    }
    else {
        $rok = 1900 + $rok;
    }

    try {
        $data = new DateTime("$rok-$mc-$dz");
    } catch (Exception $e) {
        $data = false;
    }

    return $data;
}

function weryfikujPesel($p) {

    if (!ctype_digit($p)) {
        return false;
    }

    if (strlen($p) <> 11) {
        return false;
    }

    $wagi = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
    $sKontrolna = 0;
    for ($i = 0; $i < 10; $i++) {
        $sKontrolna = $sKontrolna + ($p[$i] * $wagi[$i]);
    }

    $sKontrolna = $sKontrolna % 10;
    $sKontrolna = (10 - $sKontrolna) % 10;

    if ($p[10] != $sKontrolna) {
        return false;
    }

    if (weryfikujDateZPesel($p) == false) {
        return false;
    }

    return true;
}

function zadanie3($wejscie) {
    $odp = json_decode('{}');

    if (weryfikujPesel($wejscie) == false) {
        $odp->a = 'Niepoprawny numer PESEL';
        $odp->b = 'Wymagany poprawny numer PESEL';
    }
    else {
        $odp->a = 'Poprawny numer PESEL';
        $odp->b = pobierzPlecZPESEL($wejscie);
    }  
    $odp->c = weryfikujDateZPesel($wejscie);

    echo json_encode($odp);
}

if($_POST['zadanie'] == 'zadanie3_Uruchom') {
    zadanie3($_POST['pesel']);
  }
?>