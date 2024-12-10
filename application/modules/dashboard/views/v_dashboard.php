<div class="container-fluid">

  <?php if ($this->session->userdata['logged_in']['userlevel'] == 'Wadek' || $this->session->userdata['logged_in']['userlevel'] == 'Dekan') { ?>
    <div class="row">
      <div class="col-lg-3">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{jmlh_new}</h3>
            <p>Pengajuan Judul Baru</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>report_judul/daftar_judul_baru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{jmltolak}</h3>
            <p>Pengajuan Judul Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>report_judul/daftar_judul_ditolak" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{jmlrevisi}</h3>
            <p>Revisi</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>report_judul/daftar_judul_revisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{jmlall}</h3>
            <p>Semua Pengajuan</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>report/daftar_judul" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  <?php } else if ($this->session->userdata['logged_in']['userlevel'] == 'Koordinator Prodi' || $this->session->userdata['logged_in']['userlevel'] == 'Sekjur' || $this->session->userdata['logged_in']['userlevel'] == 'Kajur') { ?>
    <div class="row">
      <div class="col-lg-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{jmlh_new}</h3>
            <p>Pengajuan Skripsi</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/New" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{jmlrevisi}</h3>
            <p>Revisi</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Revisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{jmltolak}</h3>
            <p>Judul Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Tolak" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{jmlrev}</h3>
            <p>In Review</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Proses" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{jmlapp}</h3>
            <p>Selesai Approve</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/history_review" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{new_mbkm}</h3>
            <p>Pengajuan Judul Mbkm</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuanmbkm/list_data/new" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{revisi_mbkm}</h3>
            <p>Revisi Mbkm</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuanmbkm/list_data/revisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{tolak_mbkm}</h3>
            <p>Judul Ditolak Mbkm</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuanmbkm/list_data/ditolak" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="small-box bg-primary"> <!-- Menggunakan warna biru -->
          <div class="inner">
            <h3>{publikasinew}</h3>
            <p>Bimbingan Baru Publikasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/publikasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="small-box bg-secondary"> <!-- Menggunakan warna abu-abu -->
          <div class="inner">
            <h3>{publikasi}</h3>
            <p>Proses Bimbingan Publikasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/publikasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="small-box bg-warning"> <!-- Menggunakan warna kuning -->
          <div class="inner">
            <h3>{donepublikasi}</h3>
            <p>Selesai Bimbingan Publikasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/publikasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="row">
      <div class="col-lg-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{jmlh_new}</h3>
            <p>Pengajuan Skripsi</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/New" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{jmlrevisi}</h3>
            <p>Revisi</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Revisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{jmltolak}</h3>
            <p>Judul Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Tolak" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{jmlrev}</h3>
            <p>In Review</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Proses" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{jmlapp}</h3>
            <p>Selesai Approve</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>list/history_review" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{newsempro}</h3>
          <p>Permintaan Bimbingan Sempro Baru</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_sempro/report_baru_sempro" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{bsempropr}</h3>
          <p>Proses Bimbingan Sempro</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_sempro/report_proses_sempro" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{bsemproend}</h3>
          <p>Selesai Bimbingan Sempro</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_sempro/report_selesai_sempro" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{bskripsipr}</h3>
          <p>Proses Bimbingan Skripsi</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_skripsi/report_proses_skripsi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{bskripsiend}</h3>
          <p>Selesai Bimbingan Skripsi</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_skripsi/report_selesai_skripsi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{sempronew}</h3>
          <p>Permintaan Bimbingan Sempro Mbkm Riset Baru</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmsempro_new" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{sempro}</h3>
          <p>Proses Bimbingan Sempro Mbkm Riset</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmsempro" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{semprodone}</h3>
          <p>Selesai Bimbingan Sempro Mbkm Riset</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmsempro_done" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{skripsinew}</h3>
          <p>Permintaan Bimbingan Mbkm Riset Baru</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmskripsi_new" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{skripsi}</h3>
          <p>Proses Bimbingan Mbkm Riset</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmskripsi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{skripsidone}</h3>
          <p>Selesai Bimbingan Mbkm Riset</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>report_mbkm/mbkmskripsi_done" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{pengajuan_sidang}</h3>
          <p>Pengajuan Sidang</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>data_master/data_sidang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{ayat}</h3>
          <p>Hafalan Ayat</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{hadist}</h3>
          <p>Hafalan Hadist</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
        <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{kk}</h3>
          <p>Qiroah al Kutub</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{qq}</h3>
          <p>Qiroatul Qur'an</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>


</div>