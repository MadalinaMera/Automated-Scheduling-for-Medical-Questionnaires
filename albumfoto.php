<html>
<head>
    <title>Album foto</title>
    <link href="cssindex.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="highslide/highslide/highslide-with-gallery.packed.js"></script>
	<link rel="stylesheet" type="text/css" href="highslide/highslide/highslide.css" />
    <style>
        body{
        background-image: url(fundal.jpg);
            zoom:100%;
        }
    </style>
</head>
<body>
    <div id="tot">
        <div id="sus">
            <div id="sigla">
                <img src="hospital_logo.png" width=500px height=150px style="border-radius:10px">
            </div>
        </div>
        <div id="baranav">
            <?php
              include "baranav.php";
            ?>
        </div>
            <script type="text/javascript">
            hs.graphicsDir = 'highslide/highslide/graphics/';
           // hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.dimmingOpacity = 0.75;

            // Add the controlbar
            hs.addSlideshow({
                //slideshowGroup: 'group1',
                interval: 5000,
                repeat: false,
                useControls: false,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: 0.75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
            </script>

         <div id="principal">
            <div class="highslide-gallery" align="center">
                <a href="images/img1.jpg" class="highslide" onClick="return hs.expand(this)">
                    <img src="images/img1t.jpg" alt="imagine indisponibila"
                        title="Click to enlarge" />
                </a>
                <a href="images/img2.jpg" class="highslide" onClick="return hs.expand(this)">
                    <img src="images/img2t.jpg" alt="imagine indisponibila"
                        title="Click to enlarge" />
                </a>
                <a href="images/img3.jpg" class="highslide" onClick="return hs.expand(this)">
                    <img src="images/img3t.jpg" alt="imagine indisponibila"
                        title="Click to enlarge" />
                </a>
                <a href="images/img4.jpg" class="highslide" onClick="return hs.expand(this)">
                    <img src="images/img4t.jpg" alt="imagine indisponibila"
                        title="Click to enlarge" />
                </a>
            </div>
            <script type="text/javascript">
                <!--
                function toggleBox(szDivID, iState) // 1 visible, 0 hidden
                {
                   var obj = document.layers ? document.layers[szDivID] :
                   document.getElementById ?  document.getElementById(szDivID).style :
                   document.all[szDivID].style;
                   obj.visibility = document.layers ? (iState ? "show" : "hide") : (iState ? "visible" : "hidden");
                }
                -->
                </script>
        </div>
    </div> 
</body>
</html>