<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>
<video id="player" controls autoplay></video>
<button id="capture">Capture</button>
<button id="save">Save</button>
<canvas id="snapshot" width=320 height=240></canvas>
<script>
  var player = document.getElementById('player'); 
  var snapshotCanvas = document.getElementById('snapshot');
  var captureButton = document.getElementById('capture');
  var saveButton = document.getElementById('save');

  var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.srcObject = stream;
  };

  saveButton.addEventListener('click', function() {
    var dataURL = snapshotCanvas.toDataURL("image/png");
    $.ajax({
		  type: "POST",
		  url: "saveimage.php",
		  data: { 
		     id: "<?php echo($_GET['id']); ?>",
		     data: dataURL
		  }
		}).done(function(o) {
		  console.log('saved');
		  window.close();
		});
  });

  captureButton.addEventListener('click', function() {
    var context = snapshot.getContext('2d');
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, snapshotCanvas.width, 
        snapshotCanvas.height);
  });

  navigator.mediaDevices.getUserMedia({video: true})
      .then(handleSuccess);
</script>
</body>
</html>