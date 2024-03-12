<?php require_once "inc/init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="POS - Bootstrap Admin Template">
  <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
  <meta name="author" content="Dreamguys - Bootstrap Admin Template">
  <meta name="robots" content="noindex, nofollow">
  <title>Error Server - SE Shop PHP - Admin</title>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo APP_URL; ?>/admin/assets/img/favicon.jpg">

  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/css/animate.css">

  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/plugins/fontawesome/css/all.min.css">

  <link rel="stylesheet" href="<?php echo APP_URL; ?>/admin/assets/css/style.css">
  <style>
    div#global-loader .whirly-loader:not(:required) {
      animation: whirly-loader 1.25s linear infinite;
      background: 0 0;
      box-shadow: 0 26px 0 6px #0055ff, 0.90971px 26.05079px 0 5.93333px #0055ff,
        1.82297px 26.06967px 0 5.86667px #0055ff,
        2.73865px 26.05647px 0 5.8px #0055ff,
        3.65561px 26.01104px 0 5.73333px #0055ff,
        4.57274px 25.93327px 0 5.66667px #0055ff,
        5.48887px 25.8231px 0 5.6px #0055ff,
        6.40287px 25.68049px 0 5.53333px #0055ff,
        7.31358px 25.50548px 0 5.46667px #0055ff,
        8.21985px 25.2981px 0 5.4px #0055ff,
        9.12054px 25.05847px 0 5.33333px #0055ff,
        10.01448px 24.78672px 0 5.26667px #0055ff,
        10.90054px 24.48302px 0 5.2px #0055ff,
        11.77757px 24.1476px 0 5.13333px #0055ff,
        12.64443px 23.78072px 0 5.06667px #0055ff, 13.5px 23.38269px 0 5px #0055ff,
        14.34315px 22.95384px 0 4.93333px #0055ff,
        15.17277px 22.49455px 0 4.86667px #0055ff,
        15.98776px 22.00526px 0 4.8px #0055ff,
        16.78704px 21.48643px 0 4.73333px #0055ff,
        17.56953px 20.93855px 0 4.66667px #0055ff,
        18.33418px 20.36217px 0 4.6px #0055ff,
        19.07995px 19.75787px 0 4.53333px #0055ff,
        19.80582px 19.12626px 0 4.46667px #0055ff,
        20.5108px 18.468px 0 4.4px #0055ff, 21.1939px 17.78379px 0 4.33333px #0055ff,
        21.85416px 17.07434px 0 4.26667px #0055ff,
        22.49067px 16.34043px 0 4.2px #0055ff,
        23.10251px 15.58284px 0 4.13333px #0055ff,
        23.68881px 14.80241px 0 4.06667px #0055ff, 24.24871px 14px 0 4px #0055ff,
        24.7814px 13.1765px 0 3.93333px #0055ff,
        25.28607px 12.33284px 0 3.86667px #0055ff,
        25.76198px 11.46997px 0 3.8px #0055ff,
        26.2084px 10.58888px 0 3.73333px #0055ff,
        26.62462px 9.69057px 0 3.66667px #0055ff,
        27.01001px 8.77608px 0 3.6px #0055ff,
        27.36392px 7.84648px 0 3.53333px #0055ff,
        27.68577px 6.90284px 0 3.46667px #0055ff,
        27.97502px 5.94627px 0 3.4px #0055ff,
        28.23116px 4.97791px 0 3.33333px #0055ff,
        28.4537px 3.99891px 0 3.26667px #0055ff,
        28.64223px 3.01042px 0 3.2px #0055ff,
        28.79635px 2.01364px 0 3.13333px #0055ff,
        28.91571px 1.00976px 0 3.06667px #0055ff, 29px 0 0 3px #0055ff,
        29.04896px -1.01441px 0 2.93333px #0055ff,
        29.06237px -2.03224px 0 2.86667px #0055ff,
        29.04004px -3.05223px 0 2.8px #0055ff,
        28.98185px -4.07313px 0 2.73333px #0055ff,
        28.88769px -5.09368px 0 2.66667px #0055ff,
        28.75754px -6.1126px 0 2.6px #0055ff,
        28.59138px -7.12863px 0 2.53333px #0055ff,
        28.38926px -8.14049px 0 2.46667px #0055ff,
        28.15127px -9.1469px 0 2.4px #0055ff,
        27.87755px -10.1466px 0 2.33333px #0055ff,
        27.56827px -11.1383px 0 2.26667px #0055ff,
        27.22365px -12.12075px 0 2.2px #0055ff,
        26.84398px -13.09268px 0 2.13333px #0055ff,
        26.42956px -14.05285px 0 2.06667px #0055ff, 25.98076px -15px 0 2px #0055ff,
        25.49798px -15.93291px 0 1.93333px #0055ff,
        24.98167px -16.85035px 0 1.86667px #0055ff,
        24.43231px -17.75111px 0 1.8px #0055ff,
        23.85046px -18.63402px 0 1.73333px #0055ff,
        23.23668px -19.49789px 0 1.66667px #0055ff,
        22.5916px -20.34157px 0 1.6px #0055ff,
        21.91589px -21.16393px 0 1.53333px #0055ff,
        21.21024px -21.96384px 0 1.46667px #0055ff,
        20.4754px -22.74023px 0 1.4px #0055ff,
        19.71215px -23.49203px 0 1.33333px #0055ff,
        18.92133px -24.2182px 0 1.26667px #0055ff,
        18.10379px -24.91772px 0 1.2px #0055ff,
        17.26042px -25.58963px 0 1.13333px #0055ff,
        16.39217px -26.23295px 0 1.06667px #0055ff, 15.5px -26.84679px 0 1px #0055ff,
        14.58492px -27.43024px 0 0.93333px #0055ff,
        13.64796px -27.98245px 0 0.86667px #0055ff,
        12.69018px -28.50262px 0 0.8px #0055ff,
        11.7127px -28.98995px 0 0.73333px #0055ff,
        10.71663px -29.4437px 0 0.66667px #0055ff,
        9.70313px -29.86317px 0 0.6px #0055ff,
        8.67339px -30.2477px 0 0.53333px #0055ff,
        7.6286px -30.59666px 0 0.46667px #0055ff,
        6.57001px -30.90946px 0 0.4px #0055ff,
        5.49886px -31.18558px 0 0.33333px #0055ff,
        4.41643px -31.42451px 0 0.26667px #0055ff,
        3.32401px -31.6258px 0 0.2px #0055ff,
        2.22291px -31.78904px 0 0.13333px #0055ff,
        1.11446px -31.91388px 0 0.06667px #0055ff, 0 -32px 0 0 #0055ff,
        -1.11911px -32.04713px 0 -0.06667px #0055ff,
        -2.24151px -32.05506px 0 -0.13333px #0055ff,
        -3.36582px -32.02361px 0 -0.2px #0055ff,
        -4.49065px -31.95265px 0 -0.26667px #0055ff,
        -5.61462px -31.84212px 0 -0.33333px #0055ff,
        -6.73634px -31.69198px 0 -0.4px #0055ff,
        -7.8544px -31.50227px 0 -0.46667px #0055ff,
        -8.9674px -31.27305px 0 -0.53333px #0055ff,
        -10.07395px -31.00444px 0 -0.6px #0055ff,
        -11.17266px -30.69663px 0 -0.66667px #0055ff,
        -12.26212px -30.34982px 0 -0.73333px #0055ff,
        -13.34096px -29.96429px 0 -0.8px #0055ff,
        -14.4078px -29.54036px 0 -0.86667px #0055ff,
        -15.46126px -29.07841px 0 -0.93333px #0055ff,
        -16.5px -28.57884px 0 -1px #0055ff,
        -17.52266px -28.04212px 0 -1.06667px #0055ff,
        -18.52792px -27.46878px 0 -1.13333px #0055ff,
        -19.51447px -26.85936px 0 -1.2px #0055ff,
        -20.48101px -26.21449px 0 -1.26667px #0055ff,
        -21.42625px -25.53481px 0 -1.33333px #0055ff,
        -22.34896px -24.82104px 0 -1.4px #0055ff,
        -23.2479px -24.07391px 0 -1.46667px #0055ff,
        -24.12186px -23.29421px 0 -1.53333px #0055ff,
        -24.96967px -22.48279px 0 -1.6px #0055ff,
        -25.79016px -21.64052px 0 -1.66667px #0055ff,
        -26.58223px -20.76831px 0 -1.73333px #0055ff,
        -27.34477px -19.86714px 0 -1.8px #0055ff,
        -28.07674px -18.938px 0 -1.86667px #0055ff,
        -28.7771px -17.98193px 0 -1.93333px #0055ff,
        -29.44486px -17px 0 -2px #0055ff,
        -30.07908px -15.99333px 0 -2.06667px #0055ff,
        -30.67884px -14.96307px 0 -2.13333px #0055ff,
        -31.24325px -13.91039px 0 -2.2px #0055ff,
        -31.7715px -12.83652px 0 -2.26667px #0055ff,
        -32.26278px -11.74269px 0 -2.33333px #0055ff,
        -32.71634px -10.63018px 0 -2.4px #0055ff,
        -33.13149px -9.5003px 0 -2.46667px #0055ff,
        -33.50755px -8.35437px 0 -2.53333px #0055ff,
        -33.84391px -7.19374px 0 -2.6px #0055ff,
        -34.14px -6.0198px 0 -2.66667px #0055ff,
        -34.39531px -4.83395px 0 -2.73333px #0055ff,
        -34.60936px -3.63759px 0 -2.8px #0055ff,
        -34.78173px -2.43218px 0 -2.86667px #0055ff,
        -34.91205px -1.21916px 0 -2.93333px #0055ff, -35px 0 0 -3px #0055ff,
        -35.04531px 1.22381px 0 -3.06667px #0055ff,
        -35.04775px 2.45078px 0 -3.13333px #0055ff,
        -35.00717px 3.6794px 0 -3.2px #0055ff,
        -34.92345px 4.90817px 0 -3.26667px #0055ff,
        -34.79654px 6.13557px 0 -3.33333px #0055ff,
        -34.62643px 7.36007px 0 -3.4px #0055ff,
        -34.41316px 8.58016px 0 -3.46667px #0055ff,
        -34.15683px 9.79431px 0 -3.53333px #0055ff,
        -33.85761px 11.001px 0 -3.6px #0055ff,
        -33.5157px 12.19872px 0 -3.66667px #0055ff,
        -33.13137px 13.38594px 0 -3.73333px #0055ff,
        -32.70493px 14.56117px 0 -3.8px #0055ff,
        -32.23675px 15.72291px 0 -3.86667px #0055ff,
        -31.72725px 16.86968px 0 -3.93333px #0055ff, -31.17691px 18px 0 -4px #0055ff,
        -30.58627px 19.11242px 0 -4.06667px #0055ff,
        -29.95589px 20.2055px 0 -4.13333px #0055ff,
        -29.28642px 21.27783px 0 -4.2px #0055ff,
        -28.57852px 22.32799px 0 -4.26667px #0055ff,
        -27.83295px 23.35462px 0 -4.33333px #0055ff,
        -27.05047px 24.35635px 0 -4.4px #0055ff,
        -26.23192px 25.33188px 0 -4.46667px #0055ff,
        -25.37819px 26.27988px 0 -4.53333px #0055ff,
        -24.49018px 27.1991px 0 -4.6px #0055ff,
        -23.56888px 28.0883px 0 -4.66667px #0055ff,
        -22.6153px 28.94626px 0 -4.73333px #0055ff,
        -21.6305px 29.77183px 0 -4.8px #0055ff,
        -20.61558px 30.56385px 0 -4.86667px #0055ff,
        -19.57168px 31.32124px 0 -4.93333px #0055ff,
        -18.5px 32.04294px 0 -5px #0055ff,
        -17.40175px 32.72792px 0 -5.06667px #0055ff,
        -16.27818px 33.37522px 0 -5.13333px #0055ff,
        -15.1306px 33.98389px 0 -5.2px #0055ff,
        -13.96034px 34.55305px 0 -5.26667px #0055ff,
        -12.76875px 35.08186px 0 -5.33333px #0055ff,
        -11.55724px 35.56951px 0 -5.4px #0055ff,
        -10.32721px 36.01527px 0 -5.46667px #0055ff,
        -9.08014px 36.41843px 0 -5.53333px #0055ff,
        -7.81748px 36.77835px 0 -5.6px #0055ff,
        -6.54075px 37.09443px 0 -5.66667px #0055ff,
        -5.25147px 37.36612px 0 -5.73333px #0055ff,
        -3.95118px 37.59293px 0 -5.8px #0055ff,
        -2.64145px 37.77443px 0 -5.86667px #0055ff,
        -1.32385px 37.91023px 0 -5.93333px #0055ff !important;
      display: inline-block;
      height: 8px;
      overflow: hidden;
      position: relative;
      text-indent: -9999px;
      width: 8px;
      transform-origin: 50% 50%;
      -webkit-transform-origin: 50% 50%;
      -ms-transform-origin: 50% 50%;
      border-radius: 100%;
    }
  </style>
</head>

<body class="error-page">
  <div id="global-loader">
    <div class="whirly-loader"></div>
  </div>

  <div class="main-wrapper">
    <div class="error-box">
      <h1>500</h1>
      <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Something went wrong</h3>
      <p class="h4 font-weight-normal">The page you requested was not found.</p>
      <a href="<?php echo APP_URL; ?>" class="btn btn-primary">Back to Home</a>
    </div>
  </div>


  <script src="<?php echo APP_URL; ?>/admin/assets/js/jquery-3.6.0.min.js"></script>

  <script src="<?php echo APP_URL; ?>/admin/assets/js/feather.min.js"></script>

  <script src="<?php echo APP_URL; ?>/admin/assets/js/jquery.slimscroll.min.js"></script>

  <script src="<?php echo APP_URL; ?>/admin/assets/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo APP_URL; ?>/admin/assets/js/script.js"></script>
</body>

</html>