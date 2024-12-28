<!DOCTYPE html>
<html>
<head>
    <title>Contoh Koneksi Mesin Absensi Menggunakan SOAP Web Service</title>
</head>
<body style="background-color: #caffcb;">

<h3>Download Log Data</h3>

<?php
// Menggunakan $_GET untuk mengambil nilai dari URL
$IP = $_GET['ip'] ?? '192.168.1.3';
$Key = $_GET['key'] ?? '12345';
?>

<form action="tarik-data.php" method="get">
    IP Address: <input type="text" name="ip" value="<?= htmlspecialchars($IP, ENT_QUOTES, 'UTF-8') ?>" size="15"><br>
    Comm Key: <input type="text" name="key" size="5" value="<?= htmlspecialchars($Key, ENT_QUOTES, 'UTF-8') ?>"><br><br>
    <input type="submit" value="Download">
</form>
<br>

<?php
if (!empty($IP)) {
    ?>
    <table cellspacing="2" cellpadding="2" border="1">
        <tr align="center">
            <td><b>UserID</b></td>
            <td width="200"><b>Tanggal & Jam</b></td>
            <td><b>Verifikasi</b></td>
            <td><b>Status</b></td>
        </tr>
    <?php
    $errno = null;
    $errstr = null;
    $Connect = fsockopen($IP, 4370, $errno, $errstr, 1);
    if ($Connect) {
		$soap_request = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">$Key</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
        $newLine = "\r\n";
        fwrite($Connect, "POST /iWsService HTTP/1.0" . $newLine);
        fwrite($Connect, "Content-Type: text/xml" . $newLine);
        fwrite($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
        fwrite($Connect, $soap_request . $newLine);


        $buffer = "";
        while ($Response = fgets($Connect)) {
			echo "aaa";
            $buffer .= $Response;
			echo $buffer;
        }
		echo $buffer;
		exit;

        //include("parse.php");
        /* $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $rows = explode("\r\n", $buffer);

        foreach ($rows as $row) {
            $data = Parse_Data($row, "<Row>", "</Row>");
            $PIN = Parse_Data($data, "<PIN>", "<\/PIN>");
            $DateTime = Parse_Data($data, "<DateTime>", "<\/DateTime>");
            $Verified = Parse_Data($data, "<Verified>", "<\/Verified>");
            $Status = Parse_Data($data, "<Status>", "<\/Status>");
            ?>
            <tr align="center">
                <td><?= htmlspecialchars($PIN, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($DateTime, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($Verified, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($Status, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <?php
        } */
    } else {
        echo "Koneksi Gagal: $errstr ($errno)";
    }
    ?>
    </table>
<?php } ?>

</body>
</html>
