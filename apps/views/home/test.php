<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Camera API</title>
        <style type="text/css">
html {
font: 100%/1.3 Verdana, Helvetica, Arial, sans-serif;
    height: 100%;
}

body {
font: 70%/1.3 Verdana, Helvetica, Arial, sans-serif;
}

h1 {
font: bold 2em Arial, sans-serif;
}
                       
h2 {
font: bold 1.5em Arial, sans-serif;
}
                       
h3 {
font: bold 1.25em Arial, sans-serif;
}
                       
h4 {
font: bold 1.1em Arial, sans-serif;
}

/* Default resetting */
html, body, form, fieldset, legend, dt, dd {
margin: 0;
padding: 0;
}

h1, h2, h3, h4, h5, h6, p, ul, ol, dl {
margin: 0 0 1em;
padding: 0;
}

h1, h2, h3, h4, h5, h6 {
margin-bottom: 0.5em;
}

h2 {
    margin-top: 20px;
}

pre {
font-size: 1.5em;
}

li, dd {
margin-left: 1.5em;
}

img {
    border: none;
vertical-align: middle;
}

/* Basic element styles */
a {
color: #000;
}

a:hover {
text-decoration: underline;
}

html {
color: #000;
min-height: 100%;	
}

body {
    min-height: 100%;
    background-image: -moz-linear-gradient(top, #ccc, #fff);
    background-image: -webkit-linear-gradient(top, #ccc, #fff);
    padding-top: 20px;
}


body {
margin-bottom: 30px;
}

ul {
    margin: 10px 0;
}


/* Structure */
.container {
    width: 560px;
min-height: 600px;
background: #fff;
border: 1px solid #ccc;
border-top: none;
margin: 0 auto;
padding: 20px;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
-moz-box-shadow: 1px 1px 10px #000;
-webkit-box-shadow: 1px 1px 5px #000;
box-shadow: 1px 1px 10px #000;
}

@media screen and (max-width: 320px) {
    #container {
        width: 280px;
        padding: 10px;
    }
}

button {
    display: block;
    margin-bottom: 20px;
}

#error {
    color: #f00;
}

.footer {
    border-top: 1px solid #000;
    margin-top: 30px;
    padding-top: 10px;
}

		</style>
       
    </head>
 
    <body>
 
        <div class="container">
            <h1>Camera API</h1>
 
            <section class="main-content">
                <p>A demo of the Camera API, currently implemented in Firefox and Google Chrome on Android. Choose to take a picture with your device's camera and a preview will be shown through createObjectURL or a FileReader object (choosing local files supported too).</p>
 
                <p>
                    <input type="file" id="take-picture" accept="image/*">
                </p>
 
                <h2>Preview:</h2>
                <p>
                    <img src="about:blank" alt="" id="show-picture">
                </p>
 
                <p id="error"></p>
 
            </section>
 <a href="<?php echo base_url('template/CameraUpload.apk');?>">sdfasdflink</a>
            <p class="footer">All the code is available in the <a href="https://github.com/robnyman/robnyman.github.com/tree/master/camera-api">Camera API repository on GitHub</a>.</p>
        </div>
 
 
        <script>
        (function () {
            var takePicture = document.querySelector("#take-picture"),
                showPicture = document.querySelector("#show-picture");

            if (takePicture && showPicture) {
                // Set events
                takePicture.onchange = function (event) {
                    // Get a reference to the taken picture or chosen file
                    var files = event.target.files,
                        file;
                    if (files && files.length > 0) {
                        file = files[0];
                        try {
                            // Get window.URL object
                            var URL = window.URL || window.webkitURL;

                            // Create ObjectURL
                            var imgURL = URL.createObjectURL(file);

                            // Set img src to ObjectURL
                            showPicture.src = imgURL;

                            // Revoke ObjectURL
                            URL.revokeObjectURL(imgURL);
                        }
                        catch (e) {
                            try {
                                // Fallback if createObjectURL is not supported
                                var fileReader = new FileReader();
                                fileReader.onload = function (event) {
                                    showPicture.src = event.target.result;
                                };
                                fileReader.readAsDataURL(file);
                            }
                            catch (e) {
                                // Display error message
                                var error = document.querySelector("#error");
                                if (error) {
                                    error.innerHTML = "Neither createObjectURL or FileReader are supported";
                                }
                            }
                        }
                    }
                };
            }
        })();
        </script>
 
 
    </body>
</html>

