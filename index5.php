<?php
	//koneksi database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dbhf";

    $koneksi = mysqli_connect($server, $user, $pass, $database);

    //edit produk
    if(isset ($_POST['gsimpan']))
    {
        //pengujian data edit /simpan baru
        if($_GET['perihal'] == "edit")
        {
            $nama_file = $_FILES['gfiles']['name'];
            $edit = mysqli_query ($koneksi, "UPDATE tgmbr SET
            title ='$_POST[gnama]',
            hrga  ='$_POST[ghrga]',
            files ='$nama_file'
            WHERE id_img = '$_GET[id]'
            ");

            if($edit)
            {
                echo "<script>
                        alert('edit data Success!');
                        document.location='index5.php';
                    </script>";
            }
            else
            {
                echo "<script>
                        alert('edit GAGAL !!');
                        document.location='index5.php';
                    </script>";
            }
        }

        else
        { 
            $nama = $_POST['gnama'];
            $harga = $_POST['ghrga'];
            $nama_file = $_FILES['gfiles']['name'];
            $source = $_FILES['gfiles']['tmp_name'];
            $folder ='./upload/';
    
            move_uploaded_file($source, $folder.$nama_file);
            $edit = mysqli_query($koneksi, "INSERT INTO tgmbr VALUES (
            NULL,
            '$nama',
            '$nama_file',
            '$harga')");
    
            if($edit)
            {
                echo "<script>
                        alert('Upload data Success!');
                        document.location='index5.php';
                        
                    </script>";
            }
            else
            {
                echo "<script>
                        alert('Upload GAGAL !!');
                        document.location='index5.php';
                    </script>";
            }
        } 
    }

    if(isset ($_GET['perihal']))
    {
        if($_GET['perihal'] == "edit")
        {
            //tampil data edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM tgmbr WHERE id_img = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data di temukan
                $inama = $data['title'];
                $ifile = $data['files'];
                $ihrga = $data['hrga'];
            }
        }
        else if($_GET['perihal'] == "hapus")
        {
            $hapus = mysqli_query($koneksi, "DELETE FROM tgmbr WHERE id_img = '$_GET[id]' ");
            if($hapus)
            {
                echo "<script>
                        alert('Hapus data Success !!');
                        document.location='index5.php';
                    </script>";    
            }
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
  <title>Healthy Food</title>       
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange" data-background-color="black" data-image="./assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Admin
        </a>
      </div>
      <div class="sidebar-wrapper">
      <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="./index2.php">
              <p>Data Pembeli</p>
            </a>
          </li>
          </li>
          <li class="nav-item active ">
            <a class="nav-link" href="./index5.php">
              <p>Kelola Data</p>
            </a>
          </li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">Kelola Data</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">
                  <i class="fa fa-power-off"></i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title mt-0"> Edit Menu</h4>
                  <p class="card-category"> Isikan Menu dengan lengkap</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <h5 class="card-category">Title</h5>  
                                <input type="text" name="gnama" value="<?=@$inama?>" class="form-control" placeholder="input title..." required />
                        </div>
                        <div class="form-group">
                            <h5 class="card-category">Harga</h5>  
                                <input type="text" name="ghrga" value="<?=@$ihrga?>" class="form-control" placeholder="input title..." required />
                        </div>
                        <div class="custom-file mb-3">
                            <label for="formFileDisabled" class="form-label"><h5>Gambar</h5></label>
                            <input class="form-control" type="file" value="<?=@$ifile?>" id="customFile" name="gfiles" required /><br>
                            <!--<input type="file" class="custom-file-input" id="customFile" name="gfiles" required>-->
                        </div>
                                <button type="submit" class="btn btn-success" name="gsimpan">Simpan</button>
                                <button type="reset" class="btn btn-danger" name="greset">Reset</button>
                    </form>
                  </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title ">Menu</h4>
                        <p class="card-category"> Daftar Menu Healthy Food</p>
                    </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                            <th scope="col">id_img</th>
                            <th scope="col">Title </th>
                            <th scope="col">Harga</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Setting</th>
                        </tr>
                    </thead>
                        <?php
                          $tampil = mysqli_query ($koneksi, "SELECT * from tgmbr order by id_img desc");
                          while($data = mysqli_fetch_array($tampil)):
							          ?>

                      <tbody>
                        <tr>
                                <td><?=$data['id_img']?></td>
                                <td><?=$data['title']?></td> 
                                <td><?=$data['hrga']?></td>                         
                                <td><?=$data['files']?></td>
                                <td>
                                    <a href="index5.php?perihal=edit&id=<?=$data['id_img']?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="index5.php?perihal=hapus&id=<?=$data['id_img']?>" onclick = "return confirm('Apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
						          	<?php endwhile;// akhir while?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="./assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>