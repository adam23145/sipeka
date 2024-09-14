<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita Acara Bimbingan Skripsi</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        hr {
            border-top: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        .barcode {
            position: absolute;
            top: 0px;
            right: 20px;
        }

        .content {
            margin-top: 40px;
        }

        .barcode img {
            width: 150px;
        }

        /* Customizing table lines to be simple and not thick */
        table.simple-table,
        table.simple-table td {
            border: 1px solid black;
        }

        table.simple-table {
            border: 1px solid black;
        }

        table.simple-table td {
            border: 1px solid black;
            padding: 10px;
        }

        /* Break page before monitoring section */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="barcode">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= urlencode($subcode); ?>&code=Code128&translate-characters=true" alt="NIM Barcode">
    </div>
    <div class="content">
        <hr>
        <hr>
        <table>
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
                                <span>Laman: www.trunojoyo.ac.id</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>
        <hr>

        <table>
            <tr>
                <td align="center">
                    <span style="font-weight: bold;text-decoration: underline;">BERITA ACARA BIMBINGAN SKRIPSI</span>
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
                            <td colspan="10"><?php echo $student_name; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Nim</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?php echo $nim; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Program studi</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?php echo $jurusan; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Judul Skripsi</td>
                            <td width="20px">:</td>
                            <td colspan="10"><?php echo $title; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Waktu Pengajuan Skripsi</td>
                            <td width="20px">:</td>
                            <td colspan="10">Semester Ganjil / Genap *) Tahun Ajaran _________________</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="120px">Berlaku s.d</td>
                            <td width="20px">:</td>
                            <td colspan="10">Semester Ganjil / Genap *) Tahun Ajaran _________________</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">
                    Mengetahui,
                </td>
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
                            <td align="center" style="text-decoration: underline;" width="50%">
                                <?php echo $nama; ?>
                            </td>
                            <td align="center" style="text-decoration: underline;" width="50%">
                                <?php echo $namakoor; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" width="50%">NIP. <?php echo $dosbing; ?></td>
                            <td align="center" width="50%">NIP. <?php echo $nipkoor; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Page Break for Monitoring Section -->
    <div class="page-break"></div>

    <div class="content">
        <table class="simple-table" style="font-size: 14px">
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
            <?php
            $i = 0;
            foreach ($log_bimbingan as $row) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td colspan="2"><?php echo $row['tanggal']; ?></td>
                    <td colspan="8"><?php echo $row['topik']; ?></td>
                    <td colspan="2"><br></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="13">
                    Jumlah Pembimbingan ke Pembimbing: <?php echo $jumlb; ?> kali
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
