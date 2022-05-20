var $image = $('#image');

$image.cropper({
  aspectRatio: NaN,
  crop: function (event) {
    console.log(event.detail.x);
    console.log(event.detail.y);
    console.log(event.detail.width);
    console.log(event.detail.height);
    console.log(event.detail.rotate);
    console.log(event.detail.scaleX);
    console.log(event.detail.scaleY);
  }
});

// Get the Cropper.js instance after initialized
var cropper = $image.data('cropper');

$("#crop").on("click", function () {
  var canvas = $image.cropper('getCroppedCanvas');
  $("#place_image").append(canvas);
  return;
})

$("#plus").on("click", function () {
  $image.cropper('rotate', +1);
  return;
})

$("#minus").on("click", function () {
  $image.cropper('rotate', -1);
  return;
})

$("#get_image").on("click", function () {
  var canvas = document.getElementsByTagName('canvas');

  // DATAURL: Actual image generation via data url
  var target = new Image();
  target.src = canvas[0].toDataURL();

  document.getElementById('place_image2').appendChild(target);
})