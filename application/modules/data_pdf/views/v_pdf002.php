<!DOCTYPE html>
<html>

<head>
    <meta name="viewpayslip" content="width=device-width, initial-scale=1">
    <title>BA Bimbingan Seminar Proposal</title>
    <style>
    </style>
</head>

<body style='font-family: "Times New Roman", Times, serif; padding-top: -30px'>
    <hr style="border-top: 1px solid black;">
    <hr style="border-top: 1px solid black;">
    <table width="100%" style="" >
        <tr>
            <td  align="left">
                <table>
                    <tr>
                        <td>
                            <img src="public/assets/core/images/logotrunojoyo.jpeg" width="120px"></td>
                        </td>
                        <td style="padding-left: 25px"  align="center">
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
                <span style="font-weight: bold;text-decoration: underline;">BERITA ACARA BIMBINGAN SEMINAR PROPOSAL</span>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table style="font-size: 14px">
                    <tr>
                        <td colspan="2" width="120px">Nama mahasiswa</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $student_name?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Nim</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $nim?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Program studi</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $jurusan?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Judul Skripsi</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $title?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="120px">Dosen Pembimbing</td>
                        <td width="20px">:</td>
                        <td colspan="10"><?php echo $nama?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" width="100%" style="font-size: 14px" >
                    <tr>
                        <td colspan="13" align="center">
                            MONITORING KEGIATAN PEMBIMBINGAN
                        </td>
                    </tr>
                    <tr>
                        <td width="30px">
                            No
                        </td>
                        <td colspan="2">
                            Tanggal
                        </td>
                        <td colspan="8">
                            Topik Pembimbingan
                        </td>
                        <td colspan="2">
                            Paraf Pembimbing
                        </td>
                    </tr>
                    <?php 

                        // $db = pg_connect("host=localhost port=5432 dbname=sipeka user=dwi password=m@nus14sup3r");

                        $query = " SELECT * FROM log_bimbingan WHERE submission_code = '$submission_code' ";
                        $result = pg_query($query);

                        
                    ?>
                    <?php $i = 0;
                            while ($row = pg_fetch_row($result))
                            {
                                $i = $i+1;
                        ?>
                    <tr>
                        
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $row[7]?>
                                </td>
                                <td colspan="8">
                                    <?php echo $row[2]?>
                                </td>
                                <td colspan="2" >
                                    <br>
                                </td>
                            
                    </tr>
                    <?php }?>
                    <tr>
                        <td colspan="13">
                            Jumlah Pembimbingan ke Pembimbing : <?php echo $jumlb ?> kali
                        </td>
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
                        <td align="center" width="50%">
                            Pembimbing
                        </td>
                        <td align="center" width="50%">
                            Ketua Program Studi
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td align="center" style="text-decoration: underline;" width="50%">
                            <?php echo $nama?>
                        </td>
                        <td align="center" style="text-decoration: underline;" width="50%">
                            <?php echo $namakoor?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" width="50%">
                            NIP. <?php echo $dosbing?>
                        </td>
                        <td align="center" width="50%">
                            NIP. <?php echo $nipkoor?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            
        </tr>
        
    </table>

</body>

</html>