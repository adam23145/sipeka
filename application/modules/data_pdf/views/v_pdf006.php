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
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            height: 100px;
        }

        .signature-table .underline {
            text-decoration: underline;
        }

        .signature-spacing {
            padding-top: 40px;
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
                <table width="100%">
                    <tr>
                        <td>Koordinator Program Studi</td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>Bangkalan,</td>
                    </tr>
                    <tr>
                        <td><?= $jurusan; ?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>Pemohon</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;"><?= $namakoor; ?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td style="text-decoration: underline;"><?= $student_name; ?></td>
                    </tr>
                    <tr>
                        <td>NIP: <?= $nipkoor; ?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>NIM: <?= $nim; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr align="center">
            <td>Dosen Pembimbing</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
            <td>&nbsp;</td>
        </tr>
        <tr align="center">
            <td style="text-decoration: underline;"><?= $nama; ?></td>
        </tr>
        <tr align="center">
            <td>NIP: <?= $dosbing; ?></td>
        </tr>
    </table>

    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>