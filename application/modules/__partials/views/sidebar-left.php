<aside class="main-sidebar sidebar-light-primary elevation-4">

  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url(); ?>public/assets/core/images/logo1.png" alt="SIPEKA LOGO" class="brand-image img-circle elevation-8" style="opacity: 1">
    <span style="font-weight: bolder;font-style: italic;color: #064B74;font-size: 25px" class="brand-text">SIPEKA</span>
  </a>

  <div style="margin-top: 65px" class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        $seg1   = $this->uri->segment(1);
        $seg2   = $this->uri->segment(2);
        $seg3   = $this->uri->segment(3);
        $seg4   = $this->uri->segment(4);

        $userlevel = $this->session->userdata['logged_in']['userlevel'];
        ?>
        <?php if ($userlevel == 'mahasiswa') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>dashboard_mhs" <?= ($seg1 == "dashboard") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php } else if ($userlevel == 'Admin Lab') { ?>

        <?php } else { ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>dashboard" <?= ($seg1 == "dashboard") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>verifikasi/Verifikasisempro" <?= ($seg1 == "Verifikasisempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-book"></i>
              <p>
                Verifikasi Data Sempro
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>verifikasi/Verifikasiskripsi" <?= ($seg1 == "Verifikasiskripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-book"></i>
              <p>
                Verifikasi Data Skripsi
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($userlevel == 'superadmin') { ?>
          <li <?= ($seg1 == "data_master") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "data_master") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_login" <?= ($seg2 == "data_login") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Login</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_publikasi" <?= ($seg2 == "data_publikasi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Publikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_sidang" <?= ($seg2 == "data_sidang") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Sidang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_group" <?= ($seg2 == "data_group") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/mapping_group" <?= ($seg2 == "mapping_group") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_ayat" <?= ($seg2 == "data_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_hadist" <?= ($seg2 == "data_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_kk" <?= ($seg2 == "data_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Kiratul Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_qq" <?= ($seg2 == "data_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Kiratul Quran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/mapping_hafalan_ayat" <?= ($seg2 == "mapping_hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/mapping_hafalan_hadist" <?= ($seg2 == "mapping_hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/mapping_hafalan_kk" <?= ($seg2 == "mapping_hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/mapping_hafalan_qq" <?= ($seg2 == "mapping_hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Qiraatul Quran</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($userlevel == 'Admin Prodi') { ?>
          <li <?= ($seg1 == "data_master") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "data_master") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_login" <?= ($seg2 == "data_login") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master login</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_publikasi" <?= ($seg2 == "data_publikasi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Publikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_sidang" <?= ($seg2 == "data_sidang") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Sidang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_mahasiswa" <?= ($seg2 == "data_mahasiswa") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_dosen" <?= ($seg2 == "data_dosen") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Dosen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_prodi" <?= ($seg2 == "data_prodi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Prodi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_matkul" <?= ($seg2 == "data_matkul") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Mata Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_mhsout" <?= ($seg2 == "data_mhsout") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Mahasiswa Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_mhsact" <?= ($seg2 == "data_mhsact") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Mahasiswa Activity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_sempro" <?= ($seg2 == "data_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Update Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_update_skripsi" <?= ($seg2 == "data_update_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Update Skripsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/data_skripsi" <?= ($seg2 == "data_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Skripsi</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/bimbingan_skripsi" <?= ($seg2 == "bimbingan_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bimbingan Skripsi</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_master/rekap_bimbingan_skripsi" <?= ($seg2 == "rekap_bimbingan_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Bimbingan Skripsi</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($userlevel == 'Admin Lab') { ?>
          <li <?= ($seg1 == "data_hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "data_hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Master Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_hafalan/data_ayat" <?= ($seg2 == "data_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_hafalan/data_hadist" <?= ($seg2 == "data_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_hafalan/data_kk" <?= ($seg2 == "data_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Kiratul Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>data_hafalan/data_qq" <?= ($seg2 == "data_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Kiratul Quran</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "mapping") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "mapping") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Mapping Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>mapping/mapping_hafalan_ayat" <?= ($seg2 == "mapping_hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>mapping/mapping_hafalan_hadist" <?= ($seg2 == "mapping_hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>mapping/mapping_hafalan_kk" <?= ($seg2 == "mapping_hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>mapping/mapping_hafalan_qq" <?= ($seg2 == "mapping_hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mapping Qiraatul Quran</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($userlevel == 'mahasiswa') { ?>
          <li <?= ($seg1 == "form") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "form") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Form
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>form/form_judul" <?= ($seg2 == "form_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Pengajuan Judul</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>form/form_sempro" <?= ($seg2 == "form_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>form/Form_skripsiriset" <?= ($seg2 == "Form_skripsiriset") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Skripsi Riset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>form/form_publikasi" <?= ($seg2 == "form_publikasi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Publikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>form/form_sidang" <?= ($seg2 == "form_sidang") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Sidang</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "history") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "history") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Histori
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/historis" <?= ($seg2 == "historis") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Pengajuan Judul</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/publikasi" <?= ($seg2 == "publikasi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historis Publikasi</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/skripsiriset" <?= ($seg2 == "skripsiriset") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historis Skripsi Riset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/sidang" <?= ($seg2 == "sidang") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historis Pengajuan Sidang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/bimbingan_sempro" <?= ($seg2 == "bimbingan_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>history/bimbingan_skripsi" <?= ($seg2 == "bimbingan_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Bimbingan Skripsi</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "dokumen") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "dokumen") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file"></i>
              <p>
                Dokumen
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dokumen/list_sempro" <?= ($seg2 == "list_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Dokumen Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dokumen/list_dokumen" <?= ($seg2 == "list_dokumen") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>File Dokumen</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($userlevel == 'Koordinator Prodi' || $userlevel == 'Sekjur' || $userlevel == 'Kajur') { ?>
          <li <?= ($seg1 == "list") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "list") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                List Pengajuan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/New" <?= ($seg4 == "New") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Revisi" <?= ($seg4 == "Revisi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Revisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>list/skripsi_riset" <?= ($seg4 == "skripsi_riset") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Skripsi Riset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>list/list_pengajuan/list_data/Tolak" <?= ($seg4 == "Tolak") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Ditolak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>list/history_review" <?= ($seg2 == "history_review") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>History Review</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "report_sempro") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "report_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Bimbingan Sempro
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report_sempro/report_sempro_baru" <?= ($seg2 == "report_sempro_baru") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bimbingan Sempro Baru</p>
                  </a>
                </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_baru_sempro" <?= ($seg2 == "report_baru_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Req Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_proses_sempro" <?= ($seg2 == "report_proses_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proses Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_selesai_sempro" <?= ($seg2 == "report_selesai_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai Bimbingan Sempro</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "report_skripsi") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "report_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Bimbingan Skripsi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report_skripsi/report_skripsi_baru" <?= ($seg2 == "report_skripsi_baru") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bimbingan Skripsi Baru</p>
                  </a>
                </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_skripsi/report_proses_skripsi" <?= ($seg2 == "report_proses_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proses Bimbingan Skripsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_skripsi/report_selesai_skripsi" <?= ($seg2 == "report_selesai_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai Bimbingan Skripsi</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>

        <?php } ?>

        <?php if ($userlevel == 'Wadek' || $userlevel == 'Dekan') { ?>
          <li <?= ($seg1 == "report_judul") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "report_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Data Pengajuan Judul
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_judul/daftar_judul_baru" <?= ($seg2 == "daftar_judul_baru") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Judul Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_judul/daftar_judul_ditolak" <?= ($seg2 == "daftar_judul_ditolak") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Judul Ditolak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_judul/daftar_judul_revisi" <?= ($seg2 == "daftar_judul_revisi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Judul Revisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report/daftar_judul" <?= ($seg2 == "daftar_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Pengajuan Judul</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "monitoring") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "monitoring") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Monitoring
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>monitoring/monitoring_mahasiswa" <?= ($seg2 == "monitoring_mahasiswa") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monitoring Mahasiwa</p>
                </a>
              </li>
            </ul>
          </li>
          <li <?= ($seg1 == "report_sempro") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "report_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Bimbingan Sempro
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report_sempro/report_sempro_baru" <?= ($seg2 == "report_sempro_baru") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bimbingan Sempro Baru</p>
                  </a>
                </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_baru_sempro" <?= ($seg2 == "report_baru_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Req Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_proses_sempro" <?= ($seg2 == "report_proses_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proses Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_sempro/report_selesai_sempro" <?= ($seg2 == "report_selesai_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai Bimbingan Sempro</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "report_skripsi") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "report_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Bimbingan Skripsi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report_skripsi/report_skripsi_baru" <?= ($seg2 == "report_skripsi_baru") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bimbingan Skripsi Baru</p>
                  </a>
                </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_skripsi/report_proses_skripsi" <?= ($seg2 == "report_proses_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proses Bimbingan Skripsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>report_skripsi/report_selesai_skripsi" <?= ($seg2 == "report_selesai_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai Bimbingan Skripsi</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li <?= ($seg1 == "report") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?> >
              <a href="#" <?= ($seg1 == "report") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  Data Pengajuan Judul
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report/daftar_judul" <?= ($seg2 == "daftar_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Pengajuan Baru</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report/daftar_judul" <?= ($seg2 == "daftar_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Pengajuan Revisi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report/daftar_judul" <?= ($seg2 == "daftar_judul") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Pengajuan Revisi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report/report_sempro" <?= ($seg2 == "report_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Report Sempro</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>report/report_skripsi" <?= ($seg2 == "report_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?> >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Report Skripsi</p>
                  </a>
                </li>                
              </ul>
            </li> -->

          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>

        <?php } ?>

        <?php if ($userlevel == 'Dosen') { ?>
          <li <?= ($seg1 == "bimbingan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "bimbingan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Bimbingan Sempro
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>bimbingan/bimbingan" <?= ($seg2 == "bimbingan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bimbingan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>bimbingan/bimbingan_list" <?= ($seg2 == "bimbingan_list") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Bimbingan Sempro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>bimbingan/list_sempro" <?= ($seg2 == "list_sempro") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Sempro</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "skripsi") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Bimbingan Skripsi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>skripsi/bimbingan" <?= ($seg2 == "bimbingan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bimbingan Skripsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>skripsi/bimbingan_list" <?= ($seg2 == "bimbingan_list") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Bimbingan Skripsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>skripsi/histori_bimbingan_skripsi" <?= ($seg2 == "histori_bimbingan_skripsi") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Bimbingan Skripsi</p>
                </a>
              </li>
            </ul>
          </li>

          <li <?= ($seg1 == "hafalan") ? 'class="nav-item has-treeview menu-open"' : 'class="nav-item has-treeview"'; ?>>
            <a href="#" <?= ($seg1 == "hafalan") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Hafalan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_ayat" <?= ($seg2 == "hafalan_ayat") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Ayat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_hadist" <?= ($seg2 == "hafalan_hadist") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hafalan Hadist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_kk" <?= ($seg2 == "hafalan_kk") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiroah al Kutub</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>hafalan/hafalan_qq" <?= ($seg2 == "hafalan_qq") ? 'class="nav-link active"' : 'class="nav-link"'; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Qiraatul Qur`an</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>