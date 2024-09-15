<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BA Bimbingan Seminar Proposal</title>
    <style>
        @page {
            margin: 10mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
        }


        td {
            padding: 5px;
        }

        .barcode {
            position: absolute;
            bottom: 5mm;
            left: 0mm;
            width: 50px;
        }

        .barcode img {
            width: 150%;
        }

        .content {
            padding-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-break {
            page-break-before: always;
        }

        .monitoring-table {
            margin-top: 50px;
        }

        @media print {
            .content {
                margin-top: 100px;
            }

        }
    </style>

</head>

<body>


    <div class="barcode">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= urlencode($subcode); ?>&code=QRCode&translate-esc=on&eclevel=L" alt="NIM Barcode">
    </div>
    <div class="content" style="margin-top: 2px;">

        <hr style="border-top: 1px solid black;">
        <hr style="border-top: 1px solid black;">

        <table width="100%">
            <tr>
                <td align="left">
                    <table>
                        <tr>
                            <td>
                                <img src="<?= base_url('public/assets/core/images/logotrunojoyo.png'); ?>" width="120px">
                            </td>
                            <td style="padding-left: 25px" align="center">
                                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                                <span>Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                                <span>Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                                <span>Laman : www.trunojoyo.ac.id</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr style="border-top: 1px solid black;">
        <hr style="border-top: 1px solid black;">

        <table width="100%">
            <tr>
                <td align="center">
                    <span style="font-weight: bold;text-decoration: underline;">BERITA ACARA BIMBINGAN SEMINAR PROPOSAL</span>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table style="font-size: 14px">
                        <tr>
                            <td colspan="2" width="120px">Nama mahasiswa</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?= $student_name ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Nim</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?= $nim ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Program studi</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?= $jurusan ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Judul Skripsi</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?= $title ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Dosen Pembimbing</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?= $nama ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>


        <div class="content">
            <table width="100%">
                <tr>
                    <td align="center">Mengetahui,</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="100%">
                            <tr>
                                <td align="center" width="50%">Pembimbing</td>
                                <td align="center" width="50%">Ketua Program Studi</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center" style="text-decoration: underline;" width="50%"><?= $nama ?></td>
                                <td align="center" style="text-decoration: underline;" width="50%"><?= $namakoor ?></td>
                            </tr>
                            <tr>
                                <td align="center" width="50%">NIP. <?= $dosbing ?></td>
                                <td align="center" width="50%">NIP. <?= $nipkoor ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <div class="page-break"></div>

        <table border="1" width="100%" style="font-size: 14px" class="monitoring-table">
            <tr>
                <td colspan="13" align="center">
                    MONITORING KEGIATAN PEMBIMBINGAN
                </td>
            </tr>
            <tr>
                <td width="30px">No</td>
                <td colspan="2">Tanggal</td>
                <td colspan="8">Topik Pembimbingan</td>
                <td colspan="2">Paraf Pembimbing</td>
            </tr>
            <?php $i = 0;
            foreach ($log_bimbingan as $row) {
                $i++;
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td colspan="2"><?= $row['tanggal'] ?></td>
                    <td colspan="8"><?= $row['topik'] ?></td>
                    <td colspan="2"><br></td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="13">
                    Jumlah Pembimbingan ke Pembimbing: <?= $jumlb ?> kali
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>