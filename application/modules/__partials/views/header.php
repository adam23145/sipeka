<nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Info Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <p style="font-size: 18px; color: white;"><?php echo $this->session->userdata['logged_in']['username']; ?></p>
            </a>
        </li>
        <!-- User Image Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="image">
                    <?php 
                    $image = $this->session->userdata['logged_in']['image'];
                    $dir = $this->session->userdata['logged_in']['dir'];

                    if ($image == 'no_image.jpg') {
                        $direktori = 'public/assets/core/images/user2-160x160.jpg';
                    } else {
                        $direktori = $dir . $image;
                    }
                    ?>
                    <img src="<?php echo base_url() . $direktori; ?>" class="user-image" alt="User Image">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu">
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url(); ?>profile/ch_passwd" class="dropdown-item">
                    <i class="fas fa fa-key"></i> Change Password
                </a>

                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url(); ?>profile" class="dropdown-item">
                    <i class="fas fa fa-user"></i> Edit Profile
                </a>

                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<style>
    .user-image {
        width: 35px;
        height: 35px;
        object-fit: cover; /* Ensures the image keeps its aspect ratio and fills the box */
        border-radius: 50%; /* Makes the image circular */
    }
</style>
