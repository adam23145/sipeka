<!DOCTYPE html>
<html>

<head>
    <meta name="viewpayslip" content="width=device-width, initial-scale=1">
    <title>Form Persetujuan Dosen Pembimbing</title>
    <style>
    </style>
</head>

<body style='font-family: "Times New Roman", Times, serif;'>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">

    <table width="100%" >
        <tr>
            <td align="center">
                <span style="text-decoration: underline;font-weight: bold">BERITA ACARA UJIAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span>Pada,</span></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Hari, Tanggal</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pukul</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        
        <tr><td>&nbsp;</td></tr>
        <tr><td>Telah dilaksanakan Ujian  Skripsi oleh,</td></tr>
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
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
            <td><span>Dengan hasil,</span></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>LULUS / TIDAK LULUS :</td>
                        <!-- <td>:</td>
                        <td>&nbsp;</td> -->
                    </tr>
                    <tr>
                        <td>NILAI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <!-- <td>:</td> -->
                        <!-- <td>&nbsp;</td> -->
                    </tr>
                </table>
            </td>
        </tr>
        <!-- <tr><td>&nbsp;</td></tr> -->
        <tr>
            <td align="center">
                <table width="100%">
                    <tr align="center">
                        <td colspan="3">
                            Mengetahui dan menilai
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr align="center">
                        <td>
                            Dosen Pembimbing
                        </td>
                        <td>
                            Dosen Penguji I
                        </td>
                        <td>
                            Dosen Penguji  II
                        </td>
                    </tr>
                    <tr ><td>&nbsp;</td></tr>
                    <tr ><td>&nbsp;</td></tr>
                    <tr align="center">
                        <td style="text-decoration: underline;">
                            <?php echo $nama?>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                    <tr align="center">
                        <td >
                            NIP. <?php echo $dosbing?>
                        </td>
                        <td>
                            NIP.
                        </td>
                        <td>
                           NIP.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table width="100%">
                    <tr align="center">
                        <td>
                            Mahasiswa yang Diuji,
                        </td>
                        <td>
                            Mengetahui,
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                           &nbsp;
                        </td>
                        <td>
                            Ketua Jurusan
                        </td>
                    </tr>
                    <tr ><td>&nbsp;</td></tr>
                    <tr ><td>&nbsp;</td></tr>
                    <tr align="center">
                        <td>
                            (<?php echo $student_name?>)
                        </td>
                        <td style="text-decoration: underline;">
                            Khoirun Nasik, SHI.,MHI
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            NIP. 197912292015041002
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>

    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">

    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="text-decoration: underline;font-weight: bold">BERITA ACARA UJIAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="border: 1px solid black;">
                <table style="font-size: 12px;margin-top: -44px"  width="100%">
                    <tr align="center">
                        <td>Tanda Tangan</td>
                    </tr>
                    <tr align="center">
                        <td>Mahasiswa</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <table border="1" width="100%">
                <tr align="center"> 
                    <td colspan="5">NILAI UJIAN  ( Numerik )</td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td>Pembimbing</td>
                    <td>Penguji I</td>
                    <td>Penguji II</td>
                    <td>Rata-Rata</td>
                </tr>
                <tr >
                    <td>Orisinal Tulisan (40%)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td>Kemampuan Penyajian & Berargumentasi (30%)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td>Teknik Penulisan (20%)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td>Penampilan Sikap & Perilaku (10%)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td colspan="4" align="right">Total</td>
                    <td></td>
                </tr>
            </table>
            <td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="1">
                    <tr align="center"> 
                        <td colspan="4">Mengetahui dan menilai</td>
                    </tr>
                    <tr align="center">
                        <td></td>
                        <td>Nama</td>
                        <td>NIP</td>
                        <td>Tanda Tangan</td>
                    </tr>
                    <tr >
                        <td>Pembimbing </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr >
                        <td>Penguji I</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr >
                        <td>Penguji II</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr align="center">
                        <td colspan="4">
                            <table width="100%">
                                <tr align="center">
                                    <td>
                                        Mengetahui,
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        Ketua Jurusan
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="text-decoration: underline;font-weight: bold">
                                        Khoirun Nasik, SHI., MHI.
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="font-weight: bold">
                                        NIP. 197912292015041002
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
        <tr ><td>&nbsp;</td></tr>
    </table>


    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="font-weight: bold">FORM PENILAIAN UJIAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>
                    <tr>
                        <td>Waktu Ujian</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr >
            <td colspan="2">
                <table align="center" border="1" width="80%">
                    <tr>
                        <td>
                            KRITERIA PENILAIAN
                        </td>
                        <td>
                            NILAI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ORIGINAL TULISAN (Bobot  40%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KEMAMPUAN PENYAJIAN & BERARGUMENTASI (Bobot 30%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           TEKNIK PENULISAN (Bobot 20%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           PENAMPILAN SIKAP DAN PERILAKU (Bobot 10%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                           JUMLAH
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td>Tanda Tangan </td>
        </tr>
        <tr>
            <td></td>
            <td>Pembimbing , </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td><?php echo $nama?></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. <?php echo $dosbing?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>


    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="font-weight: bold">FORM PENILAIAN UJIAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
         <tr>
            <td align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>
                    <tr>
                        <td>Waktu Ujian</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr >
            <td colspan="2">
                <table align="center" border="1" width="80%">
                    <tr>
                        <td>
                            KRITERIA PENILAIAN
                        </td>
                        <td>
                            NILAI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ORIGINAL TULISAN (Bobot  40%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KEMAMPUAN PENYAJIAN & BERARGUMENTASI (Bobot 30%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           TEKNIK PENULISAN (Bobot 20%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           PENAMPILAN SIKAP DAN PERILAKU (Bobot 10%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                           JUMLAH
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td>Tanda Tangan </td>
        </tr>
        <tr>
            <td></td>
            <td>Penguji I , </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP.    </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>



    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="font-weight: bold">FORM PENILAIAN UJIAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
         <tr>
            <td align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>
                    <tr>
                        <td>Waktu Ujian</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr >
            <td colspan="2">
                <table align="center" border="1" width="80%">
                    <tr>
                        <td>
                            KRITERIA PENILAIAN
                        </td>
                        <td>
                            NILAI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ORIGINAL TULISAN (Bobot  40%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KEMAMPUAN PENYAJIAN & BERARGUMENTASI (Bobot 30%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           TEKNIK PENULISAN (Bobot 20%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                           PENAMPILAN SIKAP DAN PERILAKU (Bobot 10%)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                           JUMLAH
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td>Tanda Tangan </td>
        </tr>
        <tr>
            <td></td>
            <td>Penguji II , </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP.    </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>



    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="font-weight: bold;text-decoration: underline;">DAFTAR PERBAIKAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>

        <tr>
            <td>Dari hasil ujian Skripsi,</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>   
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Perlu dilakukan beberapa perbaikan yaitu,</td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1" width="100%"> 
                    <tr>
                        <td colspan="1">
                            No
                        </td>
                        <td colspan="2">
                            Halaman
                        </td>
                        <td colspan="3">
                            Perbaikan
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="45" colspan="1">
                            
                        </td>
                        <td rowspan="45" colspan="2">
                            
                        </td>
                        <td rowspan="45" colspan="3">
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Pembimbing</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td style="text-decoration: underline;"><?php echo $nama?></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. <?php echo $dosbing?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="1">
                    <tr>
                        <td>
                            Dikontrol oleh
                        </td>
                        <td>
                            Keterangan
                        </td>
                        <td>
                            Paraf
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pembimbing
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ketua Tim Penguji
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>



    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td align="center">
                <span style="font-weight: bold;text-decoration: underline;">DAFTAR PERBAIKAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>

        <tr>
            <td>Dari hasil ujian Skripsi,</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>   
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Perlu dilakukan beberapa perbaikan yaitu,</td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1" width="100%"> 
                    <tr>
                        <td colspan="1">
                            No
                        </td>
                        <td colspan="2">
                            Halaman
                        </td>
                        <td colspan="3">
                            Perbaikan
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="45" colspan="1">
                            
                        </td>
                        <td rowspan="45" colspan="2">
                            
                        </td>
                        <td rowspan="45" colspan="3">
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Penguji I</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td >__________________________</td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="1">
                    <tr>
                        <td>
                            Dikontrol oleh
                        </td>
                        <td>
                            Keterangan
                        </td>
                        <td>
                            Paraf
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pembimbing
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ketua Tim Penguji
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>



    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td  align="left"><img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
            <td style="margin-left: -25px" align="center">
                <span style="font-size:17px;font-weight:normal;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
                <span style="font-size:17px;font-weight:bold;">FAKULTAS KEISLAMAN</span><br>
                <span style="font-size:17px;font-weight:bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
                <span >Jalan Raya Telang PO. Box 2, Kamal Bangkalan 69162</span><br>
                <span >Telepon (031) 3011146, ext. 48 Fax. (031) 3011506</span><br>
                <span >Laman : www.trunojoyo.ac.id</span>       
            </td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" >
        <tr>
            <td colspan="2" align="center">
                <span style="font-weight: bold;text-decoration: underline;">DAFTAR PERBAIKAN SKRIPSI</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>

        <tr>
            <td>Dari hasil ujian Skripsi,</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%">
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
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>Ilmu Keislaman</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><?php echo $title?></td>
                    </tr>   
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Perlu dilakukan beberapa perbaikan yaitu,</td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1" width="100%"> 
                    <tr>
                        <td colspan="1">
                            No
                        </td>
                        <td colspan="2">
                            Halaman
                        </td>
                        <td colspan="3">
                            Perbaikan
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="45" colspan="1">
                            
                        </td>
                        <td rowspan="45" colspan="2">
                            
                        </td>
                        <td rowspan="45" colspan="3">
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Penguji II</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td >__________________________</td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="1">
                    <tr>
                        <td>
                            Dikontrol oleh
                        </td>
                        <td>
                            Keterangan
                        </td>
                        <td>
                            Paraf
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pembimbing
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ketua Tim Penguji
                        </td>
                        <td>
                            sudah / belum diperbaiki *)
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
    
</body>

</html>