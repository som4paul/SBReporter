<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Maintenance Page</title>
  <link rel="shortcut icon" href="https://uploads.kolkatapolice.org/kplogo.png">

  <style type="text/css">
    @color-primary: #30A9DE;
    @color-secondary: #30A9DE;
    @color-tertiary: #30A9DE;
    @color-primary-light: #6AAFE6;
    @color-primary-dark: #8EC0E4;
    @Distance: 1000px;

    body{
      overflow: hidden;
    }

    html, body {
      position: relative;
      background: #D4DFE6 ;
      min-height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #274c5e;
    }

    .Container {
      text-align: center;
      position: relative;
    }

    .MainTitle {
      display: block;
      font-size: 2rem;
      font-weight: lighter;
      text-align: center;
      color: #414142;
    }

    .MainDescription {
      font-size: 1.2rem;
      font-weight: lighter;
      text-align: center;
      color: #6c6c6d;
    }

    .MainGraphic {
      position: relative;
    }

    .myClass {
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
      color: #224E5D;
    }

    @keyframes CogAnimation {
        0%   {transform: rotate(0deg);}
        100% {transform: rotate(360deg);}
    }

    @keyframes SpannerAnimation {
        0%   {
          transform: 
            translate3d(20px, 20px,1px)
            rotate(0deg);
        }
        10% {
          transform: 
            translate3d(-@Distance, @Distance, 1px)           
            rotate(180deg);
        }
        15% {
          transform: 
            translate3d(-@Distance, @Distance, 1px)           
            rotate(360deg);
        }    
        20% {
          transform: 
            translate3d(@Distance, -@Distance, 1px)           
            rotate(180deg);
        }
        30% {
          transform: 
            translate3d(-@Distance, @Distance, 1px)           
            rotate(360deg);
        }  
        40% {
          transform: 
            translate3d(@Distance, -@Distance, 1px)           
            rotate(360deg);
        }
        50% {
          transform: 
            translate3d(-@Distance, @Distance, 1px)           
            rotate(180deg);
        }    
        100% {
          transform: 
            translate3d(0, 0px, 0px)           
            rotate(360deg);
        }  
    }

  </style>
</head>

<body>
  <div class="Container">
    <div class="MainGraphic">
      <img src="https://uploads.kolkatapolice.org/kplogo.png" height="200px" width="200px">
    </div>
    <h1 class="MainTitle">
        Sorry! We are down for scheduled maintenance right now.
    </h1>
    <p class="MainDescription">
      We expect to be back in a couple hours. Thanks for your patience.
    </p>
  </div>
</body>

</html>
