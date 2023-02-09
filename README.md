# Skripta za izračun števila dni po obdobjih

Za znanca, ki je zaposlen v državni inštituciji, sem napisala skripto za izračun podatkov za statistično obdelavo. 

Vhodni podatki so bili podani tako: identifikacijska številka, začetni datum in končni datum (300.000 vrstic). Potrebno je bilo izračunati, koliko število dni v tem obdobju spada v vsako izmed podanih fiksnih 5 letnih obdobij.

## Uporaba

    php composer install

Vhodna datoteka mora biti poimenovana: `demoData.csv`

    php script.php

Priložen je primer izhodnih podatkov v datoteki `outputData.csv` 