<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Kelayakan Mengikuti Sidang</title>
    <style>
        @media print {
            @page {
                margin: 0in 0in;
                
                margin: 10mm;
            }

            body {
                font-family: "Times New Roman", Times, serif;
                margin: 0;
                padding: 0;
            }

            hr {
                border: 1px solid black;
                margin: 10px 0;
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
                bottom: 0;
                left: 20px;
                width: 100px;
                /* Ukuran barcode yang diperkecil */
            }

            .barcode img {
                width: 200px !important;
                /* Ukuran barcode yang lebih kecil */
            }
        }
    </style>
</head>

<body>
    <hr>
    <hr>
    <table>
        <tr>
            <td align="left">
                <table>
                    <tr>
                        <td><img src="<?= base_url('public/assets/core/images/logotrunojoyo.png'); ?>" width="120px"></td>
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
    <hr>
    <hr>

    <table>
        <tr>
            <td align="center">
                <span style="font-weight: bold;text-decoration: underline;">SURAT KELAYAKAN SEMINAR PROPOSAL</span>
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
                        <td colspan="10"><?php echo $student_name ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Nim</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $nim ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Program studi</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $jurusan ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Judul Skripsi</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $title ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Dosen Pembimbing</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $nama ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Tanggal ACC</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $tglacc ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" style="font-size: 14px">
                    <tr>
                        <td>Catatan Pembimbing</td>
                    </tr>
                    <tr>
                        <td style="height: 100px;"></td>
                    </tr>
                </table>
            </td>
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
                        <td align="center" style="text-decoration: underline;" width="50%"><?php echo $nama ?></td>
                        <td align="center" style="text-decoration: underline;" width="50%"><?php echo $namakoor ?></td>
                    </tr>
                    <tr>
                        <td align="center" width="50%">NIP. <?php echo $dosbing ?></td>
                        <td align="center" width="50%">NIP. <?php echo $nipkoor ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- Barcode di kiri bawah -->
    <div class="barcode">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= urlencode($subcode); ?>&code=Code128&translate-characters=true" alt="NIM Barcode">
    </div>

    <!-- Script untuk memunculkan dialog print otomatis -->
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>