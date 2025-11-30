<?php

function hitungDiskon($totalBelanja) {
    

    if ($totalBelanja >= 100000) {
        $nominalDiskon = $totalBelanja * 0.10;
        $keterangan = "Mendapat Diskon 10%";
    } 


    elseif ($totalBelanja >= 50000 && $totalBelanja < 100000) {
        $nominalDiskon = $totalBelanja * 0.05;
        $keterangan = "Mendapat Diskon 5%";
    } 


    else {
        $nominalDiskon = 0;
        $keterangan = "Tidak Mendapat Diskon";
    }

    return [$nominalDiskon, $keterangan];
}


$totalBelanja1 = 150000; 
$hasil1 = hitungDiskon($totalBelanja1);
$diskon1 = $hasil1[0];
$info1   = $hasil1[1];

echo "<strong>--- KONDISI 1 ---</strong><br>";
echo "Total belanja: Rp. " . $totalBelanja1 . "<br>";
echo "Status: " . $info1 . "<br>";
echo "Diskon: Rp. " . $diskon1 . "<br>";
echo "Total Bayar: Rp. " . ($totalBelanja1 - $diskon1) . "<br><br>";


$totalBelanja2 = 75000; 
$hasil2 = hitungDiskon($totalBelanja2);
$diskon2 = $hasil2[0];
$info2   = $hasil2[1];

echo "<strong>--- KONDISI 2 ---</strong><br>";
echo "Total belanja: Rp. " . $totalBelanja2 . "<br>";
echo "Status: " . $info2 . "<br>";
echo "Diskon: Rp. " . $diskon2 . "<br>";
echo "Total Bayar: Rp. " . ($totalBelanja2 - $diskon2) . "<br><br>";


$totalBelanja3 = 30000; 
$hasil3 = hitungDiskon($totalBelanja3);
$diskon3 = $hasil3[0];
$info3   = $hasil3[1];

echo "<strong>--- KONDISI 3 ---</strong><br>";
echo "Total belanja: Rp. " . $totalBelanja3 . "<br>";
echo "Status: " . $info3 . "<br>";
echo "Diskon: Rp. " . $diskon3 . "<br>";
echo "Total Bayar: Rp. " . ($totalBelanja3 - $diskon3) . "<br>";

?>