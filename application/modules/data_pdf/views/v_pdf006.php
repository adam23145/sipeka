<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita Acara Seminar Proposal</title>
    <style>
        @page {
            size: A4;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
        }

        .barcode {
            position: absolute;
            bottom: 10mm;
            left: 0mm;
            width: 100px;
        }

        .barcode img {
            width: 160%;
        }

        @media print {
            .barcode {
                display: block;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            height: 100px;
            padding: 10px;
        }

        .signature-table .underline {
            text-decoration: underline;
        }

        .signature-spacing {
            padding-top: 40px;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 10px; /* Add padding if needed */
        }

        .signature-box {
            flex: 1;
            text-align: center;
            margin: 0 20px; /* Adjust margin to increase space between boxes */
        }

        .signature-box:first-child {
            margin-right: 30px; /* Extra margin for the first signature box */
        }

        .signature-box:last-child {
            margin-left: 30px; /* Extra margin for the last signature box */
        }
    </style>
</head>

<body>
    <div class="barcode">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= urlencode($subcode); ?>&code=Code128&translate-characters=true" alt="NIM Barcode">
    </div>

    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table>
        <tr>
            <td align="left">
                <table>
                    <tr>
                        <td style="padding-right: 25px"><img src="<?= base_url('public/assets/core/images/logotrunojoyo.png'); ?>" width="120px"></td>
                        <td align="center">
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
    <table>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <span style="font-weight: bold">BERITA ACARA SEMINAR PROPOSAL/HASIL TUGAS AKHIR</span><br>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><span>Pada hari ini, telah dilaksanakan seminar proposal oleh mahasiswa berikut:</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $student_name; ?></td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td><?= $nim; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Seminar</td>
                        <td>:</td>
                        <td><?= $tanggal_sempro; ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?= $jurusan; ?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?= $title; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>DITERIMA / DIREVISI*</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Mengetahui,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <div class="signature-container">
                    <div class="signature-box">
                        <div>Pembahas</div>
                        <br></br>
                        <br></br>
                        <div style="text-decoration: underline;"><?= $pembahas; ?></div>
                        <div>NIP: <?= $nip_pembahas; ?></div>
                    </div>
                    <div class="signature-box">
                        <div>Pembimbing</div>
                        <br></br>
                        <br></br>
                        <div style="text-decoration: underline;"><?= $nama; ?></div>
                        <div>NIP: <?= $dosbing; ?></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        
        <tr align="center">
            <td>Koordinator Ta</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr align="center">
            <td style="text-decoration: underline;"><?= $namakoor; ?></td>
        </tr>
        <tr align="center">
            <td>NIP: <?= $nipkoor; ?></td>
        </tr>
    </table>

    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
