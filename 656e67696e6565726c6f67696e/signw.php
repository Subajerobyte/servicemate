<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Full-Window · Signature Pad</title>
  <style>
	* {
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
	}
	html, body {
		min-height: 100%;
		height: 100%;
		max-width: 100%;
		width: 100%;
		overflow: hidden;
	}
	html, body, form {
		margin: 0px;
	}
	html, form {
		padding: 0px;
	}
	html, body, fieldset {
		background: #aaa;
	}
	fieldset {
		position: absolute;
		border: 5px solid #aaa;
		background: #aaa;
		right: 0px;
		bottom: 0px;
	}
	canvas {
		outline: 5px solid #aaa;
		background: #fff;
	}
	input[type=submit], input[type=button], input[type=reset] {
		font-size: larger;
	}
  </style>
  <link rel="stylesheet" href="../../1637028036/vendor/sign/assets/jquery.signaturepad.css">
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>

  
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>

<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</head>
<body>
	<form method="POST" action="">
	<div id="signpad">
		<canvas class="pad" id="pad"></canvas>
		<fieldset>
			<input type="reset" value="clear" />
			<input type="button" id="btnSaveSign" value="Submit" />
		</fieldset>
		</div>
	</form>
<input type="hidden" name="output" class="output">
<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script>
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
            height: window.innerHeight,
            width: window.innerWidth
          });
        };

    $(document).ready(function() {
      $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();

      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: 'input[type=reset]',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
		  
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						dataType: 'json',
						success: function (response) {
						   window.location.reload();
						}
					});
				}
			});
		});
    });
  }(this));
  </script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
</body>
