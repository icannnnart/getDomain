<?php
error_reporting(0);
$biru = "\e[34m";
$kuning = "\e[33m";
$cyan = "\e[96m";
$magenta = "\e[35m";
$hijau = "\e[92m";
$merah = "\e[91m";
echo "\n\e[96m + ==================+\n";
echo "\e[33m Domain Grabeerrrr by date & page \n";
echo "\e[33m Example : tanggal = 2023-06-20 | page = 1\n";
echo "\e[33m Create : icanart.dev \n";
echo "\e[96m + ===================+\n \n";
echo "\n$magenta Default Auto getpage";
echo "\n$kuning Auto getpage (1)/Manual getPage (2): ";
$plh = trim(fgets(STDIN));
if ($plh == 2)
{
    echo "\n$kuning Tanggal: ";
    $tgl = trim(fgets(STDIN));
    echo "$kuning Page : ";
    $page = trim(fgets(STDIN));
    echo "\n";
    $url = "https://apinyaihsan.cloud/api/getDomain.php?tanggal=$tgl&page=$page";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $iloop = "1"; /* Outside the loop */
    while ($iloop <= 10)
    {
        $warn = "Loadingggg.....!!\r";
        if (strlen($warn) === $iloop + 1)
        {
            $iloop = "0";
        }
        $warn = str_split($warn);

        $warn[$iloop] = "\033[35;2m\e[0m" . strtoupper($warn[$iloop]);
        echo " \033[7m" . implode($warn);
        usleep(90000);
        $iloop++;
    }
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $datadomain = json_decode($resp, true);

    if (strpos($resp, 'format tanggal salah!'))
    {
        print_r("$merah \n gagal");
        print_r("$cyan");
    }
    else
    {
        $jumlah = count($datadomain['data']);
        foreach ($datadomain['data'] as $datas)
        {

            file_put_contents('result_' . $tgl . '.txt', "$datas\n", FILE_APPEND);
        }
        print_r("$hijau Sukses tersimpan dengan nama file result_$tgl.txt | total domain : $jumlah");
        print_r("$cyan");
    }
}
else
{
    echo "\n$kuning Tanggal: ";
    $tgl = trim(fgets(STDIN));
    echo "$kuning Example (1-5)";
    echo "$kuning \n Page : ";
    $page = trim(fgets(STDIN));
    echo "\n";
    $pagenya = explode("-", $page);
    $x = $pagenya[0];
    $z = $pagenya[1];
    while ($x <= $z)
    {
        $url = "https://apinyaihsan.cloud/api/getDomain.php?tanggal=$tgl&page=$x";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $iloop = "1"; /* Outside the loop */
        while ($iloop <= 15)
        {
            $warn = "Loadingggg.....!!\r";
            if (strlen($warn) === $iloop + 1)
            {
                $iloop = "0";
            }
            $warn = str_split($warn);

            $warn[$iloop] = "\033[35;2m\e[0m" . strtoupper($warn[$iloop]);
            echo " \033[7m" . implode($warn);
            usleep(90000);
            $iloop++;
        }
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $datadomain = json_decode($resp, true);

        if (strpos($resp, 'format tanggal salah!'))
        {
            print_r("$merah \n gagal");
            print_r("$cyan");
        }
        else
        {
            $jumlah = count($datadomain['data']);
            foreach ($datadomain['data'] as $datas)
            {

                file_put_contents('result_' . $tgl . '.txt', "$datas\n", FILE_APPEND);
            }
            print_r("$hijau Sukses tersimpan dengan nama file result_$tgl.txt | total domain : $jumlah");
            print_r("$cyan \n");
        }
        $x++;
    }

}

?>
