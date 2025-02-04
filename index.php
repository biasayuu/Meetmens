<?php 

session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  MeetMens
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
 <audio autoplay >

<source src="music/home (cover) by matthew hall.mp3" type="audio/mp3"/>

</audio>
<body class="g-sidenav-show  bg-gray-100">
<?php include 'sidebar.php'; ?>
 
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php include 'header.php'; ?>

    <div class="container mt-4">
    <div class="row">
    <?php
    
 
    $imageDirectory = 'foto/artikel/';
    $images = scandir($imageDirectory);
    // Remove . and .. from the list
    $images = array_diff($images, array('.', '..'));

    // Fetch 3 random artikel from the database
    $sql = "SELECT * FROM artikel ORDER BY RAND() LIMIT 6";
    $result = mysqli_query($koneksi, $sql);

    while ($tampil = mysqli_fetch_array($result)) {
        // Select a random image from the directory
        $randomImage = $images[array_rand($images)];

        // Set the background image URL
        $backgroundURL = $imageDirectory . $randomImage;
    ?>
        <div class="col-lg-4 mb-4">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover" style="background-image: url('<?php echo $backgroundURL; ?>');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3" style="overflow-y: auto;">
                        <h5 class="text-white font-weight-bolder mb-4 pt-2"><?= $tampil["judulartikel"]; ?></h5>
                        <p class="text-white" style="overflow-wrap: break-word;"><i><?= $tampil["deskripsi"]; ?></i></p>
                        <p class="text-white read-more-content" style="display: none;"><?= $tampil["isiartikel"]; ?></p>
                        <a class="text-white text-sm font-weight-bold mb-2 icon-move-right mt-auto read-more" href="javascript:void(0);">
                            Read More
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                        <button class="btn btn-secondary btn-sm mb-0 hide-content" style="display: none;">Hide</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const readMoreLinks = document.querySelectorAll('.read-more');
    const hideContentBtns = document.querySelectorAll('.hide-content');

    readMoreLinks.forEach((link, index) => {
        link.addEventListener('click', function() {
            const cardBody = this.parentNode;
            const readMoreContent = cardBody.querySelector('.read-more-content');
            const hideContentBtn = cardBody.querySelector('.hide-content');

            cardBody.style.height = 'auto';
            readMoreContent.style.display = 'block';
            this.style.display = 'none';
            hideContentBtn.style.display = 'block';
        });

        hideContentBtns[index].addEventListener('click', function() {
            const cardBody = this.parentNode;
            const readMoreContent = cardBody.querySelector('.read-more-content');
            const readMoreLink = cardBody.querySelector('.read-more');

            cardBody.style.height = 'auto';
            readMoreContent.style.display = 'none';
            readMoreLink.style.display = 'block';
            this.style.display = 'none';
        });
    });
});
</script>



  </main>
<?php include "footer.php"; ?>
</body>

</html>