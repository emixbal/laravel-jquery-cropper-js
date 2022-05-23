$( document ).ready(function() {
  var $image = $('#image');

  $image.cropper({
    aspectRatio: 3/4,
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
    $("#place_image").html();
    $("#place_image").html(canvas);
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
  
  $('#simpan').on("click", function () {
    var base64src = ""
  
    var is_no_photo = ($('#is_no_photo').is(':checked'))?1:0
    if(!is_no_photo){
      var canvas = document.getElementsByTagName('canvas');
      // DATAURL: Actual image generation via data url
  
      if(typeof(canvas[0])=="undefined"){
        alert("Crop foto terlebih dahulu")
        return
      }
  
      base64src = canvas[0].toDataURL();
    }
  
    var file_name = ($('#file_name').val()) ? $('#file_name').val() : ""
    var folder_name = ($('#folder_name').val()) ? $('#folder_name').val() : ""
    var nama = ($('#nama').val()) ? $('#nama').val() : ""
    var pob = ($('#pob').val()) ? $('#pob').val() : ""
    var dob = ($('#dob').val()) ? $('#dob').val() : ""
    var alamat = ($('#alamat').val()) ? $('#alamat').val() : ""
    var nik = ($('#nik').val()) ? $('#nik').val() : ""
    var nip = ($('#nip').val()) ? $('#nip').val() : ""
  
    if (file_name == "") {
      alert("file_name kosong")
      return
    }
    
    if (folder_name == "") {
      alert("unit kerja kosong")
      return
    }
  
    if (nama == "") {
      alert("nama kosong")
      return
    }
  
    if (pob == "") {
      alert("tempat lahir kosong")
      return
    }
    
    if (dob == "") {
      alert("tanggal lahir kosong")
      return
    }
    
    if (alamat == "") {
      alert("alamat kosong")
      return
    }
    
    if (nik == "") {
      alert("nik kosong")
      return
    }
  
    if(is_no_photo){
      var confirm_txt = "Apakah anda yakin upload tanpa foto?"
      if (confirm(confirm_txt) == true) {
        simpan()
        return
      }
    }
    simpan()
  
    function simpan(){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "http://localhost:8000/anggota_save",
        type: "POST",
        data: {
          file_name, folder_name, nama, pob, dob, alamat, nik, nip,
          image_base64:base64src
        },
        success: function (response) {
            console.log(response);
            window.location.replace("http://localhost:8000/upload");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
      });
      return;
    }
  })
})
