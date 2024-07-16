<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	 <style>
		@page { margin: .7in; }
		.bg { top: -.7in; right: -.6in; bottom: -.7in; left: -.7in; position: absolute; z-index: -1000; min-width: 13in; min-height: 11.3in; }
	</style>
</head>

<body>
	<img class="bg" width="13px" src="<?php echo $bg; ?>">
	<table style="width: 100%;">
		<tr>
			<th>
				<center>
					<table style="width: 100%;">
						<tr>
							<th style="width: 10%;text-align: left;">
									<img  src="<?php echo $image; ?>" height="100px" width="100px">
							</th>
							<th>
								<center>
									<font size="60px" color="green"><b> Sertifikat </b></font>
								</center>
							</th>
							<th style="width: 10%;text-align: left;">&nbsp;</th>
						</tr>
					</table>
				<center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					<font size="31px"><b> QIROAH AL KUTUB </b></font>
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					<font size="23px"><b> FAKULTAS KEISLAMAN </b></font>
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					<font size="23px"><b> UNIVERSITAS TRUNOJOYO MADURA </b></font>
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<font size="13px"><b> 
					No. 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
				</b></font>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					<font size="13px"><b><i> Diberikan Kepada </i></b></font>
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<table style="width: 100%;">
					<tr>
						<th style="width: 15%;">&nbsp;</th>
						<th>
							<table>
								<tr>
									<th style="text-align: left;">
											<font size="13px"><b> Nama </b></font>
									</th>
									<th>
										<center>
											<font size="13px"><b> : </b></font>
										</center>
									</th>
									<th style="text-align: left;">
											<font size="13px"><b> <?php echo $users['nama']; ?> </b></font>
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
											<font size="13px"><b> NIM </b></font>
									</th>
									<th>
										<center>
											<font size="13px"><b> : </b></font>
										</center>
									</th>
									<th style="text-align: left;">
											<font size="13px"><b> <?php echo $users['nim']; ?> </b></font>
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
											<font size="13px"><b> Program Studi </b></font>
									</th>
									<th>
										<center>
											<font size="13px"><b> : </b></font>
										</center>
									</th>
									<th style="text-align: left;">
											<font size="13px"><b> <?php echo $users['jurusan']; ?> </b></font>
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
											<font size="13px"><b> Semester </b></font>
									</th>
									<th>
										<center>
											<font size="13px"><b> : </b></font>
										</center>
									</th>
									<th style="text-align: left;">
											<font size="13px"><b> - </b></font>
									</th>
								</tr>
							</table>
						</th>
					</tr>
				</table>	
			</th>
		</tr>
		<tr>
			<th style="text-align: center;"><font size="13px">
				Telah mengikuti Tes Qiroah Al Kutub yang dikelola oleh Laboratorium Islamic Corner Fakultas Keislaman, pada tanggal <?php echo date("d F Y");?> , 
			</font></th>
		</tr>
		<tr>
			<th style="text-align: center;"><font size="13px">
				dengan nilai sebagai berikut: 
			</font></th>
		</tr>
		<tr>
			<th style="text-align: center;">
				<center>
					<table style="width: 100%;">
						<tr>
							<th width="25%"><font size="15px">&nbsp;</th>
							<th style="text-align: center;border: 1px solid black;"><font size="13px">Materi</font></th>
							<th style="text-align: center;border: 1px solid black;"><font size="13px">Nilai</font></th>
							<th width="25%"><font size="15px">&nbsp;</th>
						</tr>
						<tr>
							<th width="25%"><font size="15px">&nbsp;</th>
							<th style="text-align: left;border: 1px solid black;"><font size="13px">Baca'an</font></th>
							<th style="text-align: center;border: 1px solid black;"><font size="13px"><?php echo $users['membaca']; ?></font></th>
							<th width="25%"><font size="15px">&nbsp;</th>
						</tr>
						<tr>
							<th width="25%"><font size="15px">&nbsp;</th>
							<th style="text-align: left;border: 1px solid black;"><font size="13px">Pemahaman</font></th>
							<th style="text-align: center;border: 1px solid black;"><font size="13px"><?php echo $users['memahami']; ?></font></th>
							<th width="25%"><font size="15px">&nbsp;</th>
						</tr>
						<tr>
							<th width="25%"><font size="15px">&nbsp;</th>
							<th style="text-align: left;border: 1px solid black;"><font size="13px">Analisa</font></th>
							<th style="text-align: center;border: 1px solid black;"><font size="13px"><?php echo $users['menganalisa']; ?></font></th>
							<th width="25%"><font size="15px">&nbsp;</th>
						</tr>
					</table>
				<center>
			</th>
		</tr>
		<tr>
			<th style="text-align: center;"><font size="13px"><b> 
				dan dinyatakan LULUS dengan Nilai Rata-Rata <?php echo $users['nilai']; ?> (Predikat).
			</b></font></th>
		</tr>
		<tr>
			<th><font size="15px">&nbsp;</th>
		</tr>
		<tr>
			<th style="text-align: center;">
				<table style="width: 100%;">
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th><center>
							<table>
								<tr>
									<th style="text-align: left;">
											<font size="15px"><b> &nbsp;&nbsp;&nbsp; Dekan Fakultas Keislaman, </b></font>
									</th>
								</tr>
								<tr>
									<th>
										<center>
											<font size="15px"><b> &nbsp; </b></font>
										</center>
									</th>
								</tr>
								<tr>
									<th>
										<center>
											<font size="15px"><b> &nbsp; </b></font>
										</center>
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
											<font size="15px"><b> Shofiyun Nahidloh,S.Ag.,M.H.I </b></font>
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
											<font size="15px"> &nbsp;&nbsp;&nbsp; NIP.197605162000032003 </font>
									</th>
								</tr>
							</table>
						</center></th>
						<th><center>
							<table width="100%">
								<tr>
									<th style="text-align: right;">
											<font size="15px"><b> Ka. Lab. Islamic corner, &nbsp; </b></font>
									</th>
								</tr>
								<tr>
									<th>
										<center>
											<font size="15px"><b> &nbsp; </b></font>
										</center>
									</th>
								</tr>
								<tr>
									<th>
										<center>
											<font size="15px"><b> &nbsp; </b></font>
										</center>
									</th>
								</tr>
								<tr>
									<th style="text-align: right;">
											<font size="15px"><b> Lilissuaibah, S.Ag., M.Pd. </b></font>
									</th>
								</tr>
								<tr>
									<th style="text-align: right;">
											<font size="15px"> NIP.197703032015042001 &nbsp;</font>
									</th>
								</tr>
							</table>
						</center></th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</table>	
			</th>
		</tr>
	</table>
</body>
</html>