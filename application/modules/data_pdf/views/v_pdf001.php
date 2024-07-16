<!DOCTYPE html>
<html>

<head>
    <meta name="viewpayslip" content="width=device-width, initial-scale=1">
    <title>Form Persetujuan Dosen Pembimbing</title>
    <style>
    </style>
</head>

<body style='font-family: "Times New Roman", Times, serif;padding-top: -30px'>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td align="left">
                <table>
                    <tr>
                        <td style="padding-right: 25px" ><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
                        <td  align="center">
                            <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                            <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                            <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                            <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                            <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                            <span >Laman : www.trunojoyo.ac.id</span>       
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">

    <table width="100%" >
        <tr>
            <td align="center">
                <span style="text-decoration: underline;font-weight: bold">SURAT PERMOHONAN</span><br>
                <span style="font-weight: bold">KESEDIAAN MENJADI DOSEN PEMBIMBING</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span>Saya mahasiswa Fakultas Keislaman  Universitas Trunojoyo dengan data sebagai berikut,</span></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $student_name?></td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td><?php echo $nim?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Konsentrasi</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span>Memohon kesediaan bapak/ibu dosen dengan data di bawah ini,</span></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td><?php echo $nama?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td><?php echo $dosbing?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Untuk menjadi <b>dosen pembimbing</b></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Mengetahui,</td>
        </tr>
        <tr >
            <td>
                <table width="100%"  >
                    <tr>
                        <td>
                            Koordinator Program Studi 
                        </td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>
                            Bangkalan,
                        </td>
                    </tr>                    
                    <tr>
                        <td><?php echo $jurusan?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>Pemohon</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;"><?php echo $namakoor?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td style="text-decoration: underline;"><?php echo $student_name?></td>
                    </tr>
                    <tr>
                        <td>NIP: <?php echo $nipkoor?></td>
                        <td width="47%" colspan="2">&nbsp;</td>
                        <td>NIM: <?php echo $nim?></td>
                    </tr>
                </table>                
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr align="center">
            <td>Menyetujui untuk menjadi</td>
        </tr>
        <tr align="center">
            <td>Dosen Pembimbing </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr align="center">
            <td style="text-decoration: underline;"><?php echo $nama?></td>
        </tr>
        <tr align="center">
            <td>NIP: <?php echo $dosbing?></td>
        </tr>
    </table>
</body>

</html>