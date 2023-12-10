<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form id="myForm">
    <input type="text" name="username">
    <input type="file" name="filecuy" id="filecuy">
    <button type="submit">Coba</button>
  </form>
  
<script src="<?= BASE; ?>writable/assets/js/jquery-3.7.0.js"></script>
<script>
  $(document).ready(function() {
    $("#myForm").submit(function (e) {
      e.preventDefault();
      const form = document.getElementById('myForm');
      const formData = new FormData(form);
      const path = $("#filecuy").val();
      $.ajax(
        {
          url: '<?= BASE; ?>cobaform',
          method: 'POST',
          data: {fd: formData, pathx: path},
          processData: false,
          contentType: false,
          success: (res) => {
            let data = JSON.parse(res);
            if(data.kode == "1"){
              alert(`Hai, ${data.nama}, file kamu ini ${data.path}`);
            } else {
              alert(`Maaf, ${data.pesan}`);
            }
          },
          error: () => {
            alert("Koneksi gagal");
          }
        }
      );
    })
  })
</script>
</body>
</html>