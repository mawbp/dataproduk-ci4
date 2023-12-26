<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Produk</title>
  <link rel="stylesheet" href="<?= BASE; ?>writable/assets/css/style.css">
  <link rel="stylesheet" href="<?= BASE; ?>writable/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= BASE; ?>writable/assets/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="<?= BASE; ?>writable/assets/sweetalert2.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h1 class="rata-tengah fw-bold">Data Produk</h1>
        <div class="col-md-12"></div>
        <div class="card mt-3">
          <div class="card-header">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">Tambah data</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbproduct" class="table table-hover w100">
                <thead>
                  <tr>
                    <th class="w5">ID</th>
                    <th class="w20">Nama</th>
                    <th class="w15">Harga Beli</th>
                    <th class="w15">Harga Jual</th>
                    <th class="w10">Satuan</th>
                    <th class="w10">Kategori</th>
                    <th class="w15">Gambar</th>
                    <th class="w10">Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th class="w5">ID</th>
                    <th class="w20">Nama</th>
                    <th class="w15">Harga Beli</th>
                    <th class="w15">Harga Jual</th>
                    <th class="w10">Satuan</th>
                    <th class="w10">Kategori</th>
                    <th class="w15">Gambar</th>
                    <th class="w10">Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <br><br><br>
        <form id="addForm"></form>
        <form id="editForm"></form>
        <!-- ADD MODAL -->
        <div class="modal fade" id="addmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs20">Tambah Produk</h5>
              </div>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">ID</label>
                    <input type="text" class="form-control fadd" form="addForm" name="id" id="id">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label fw-bold fs13">Nama</label>
                    <input type="text" class="form-control fadd" form="addForm" id="nama" name="nama">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control fadd" form="addForm" id="hbeli" name="hbeli">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control fadd" form="addForm" id="hjual" name="hjual">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Satuan</label>
                    <select class="form-select cboadd" form="addForm" name="satuan" id="satuan">
                      <option value="default">--Pilih salah satu--</option>
                      <?php  
                        if(is_array($satuan)) {
                          if(count($satuan) > 0) {
                            foreach($satuan as $s) {
                              $id = $s->id;
                              $nama = $s->nama;
                              echo "<option value=$id>$nama</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Kategori</label>
                    <select class="form-select cboadd" form="addForm" name="kategori" id="kategori" oninput="imgpreviewadd()">
                      <option value="default">--Pilih salah satu--</option>
                      <?php  
                        if(is_array($kategori)) {
                          if(count($kategori) > 0) {
                            foreach($kategori as $k) {
                              $id = $k->id;
                              $nama = $k->nama;
                              echo "<option value=$id>$nama</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                      <label class="form-label fw-bold fs13">QR</label>
                      <input type="text" class="form-control fadd" form="addForm" name="qrcode" id="qrcode">
                      <div id="inv-desc" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Gambar</label>
                    <input type="file" class="form-control fadd" form="addForm" name="gambar" id="gambar" onchange="previewAdd()" accept="">
                    <div id="inv-desc" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                  <img src="writable/assets/img/default.svg" style="width: 50%;" id="img-preview" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="addForm">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="resetAdd()" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </div>
        </div>
        <!-- UPDATE MODAL -->
        <div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs20">Update Produk</h5>
              </div>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">ID</label>
                    <input type="text" class="form-control fupdate" form="editForm" name="ide" id="ide">
                    <input type="hidden" class="fupdate" form="editForm" name="idee" id="idee">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control fupdate" form="editForm" id="namae" name="namae">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control fupdate" form="editForm" id="hbelie" name="hbelie">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control fupdate" form="editForm" id="hjuale" name="hjuale">
                    <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Satuan</label>
                    <select class="form-select cboupdate" form="editForm" name="satuane" id="satuane">
                      <option>--Pilih tipe--</option>
                      <?php  
                        if(is_array($satuan)) {
                          if(count($satuan) > 0) {
                            foreach($satuan as $s) {
                              $id = $s->id;
                              $nama = $s->nama;
                              echo "<option value=$id>$nama</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Kategori</label>
                    <select class="form-select cboupdate" form="editForm" name="kategorie" id="kategorie" oninput="imgpreviewedit()">
                      <option>--Pilih tipe--</option>
                      <?php  
                        if(is_array($kategori)) {
                          if(count($kategori) > 0) {
                            foreach($kategori as $k) {
                              $id = $k->id;
                              $nama = $k->nama;
                              echo "<option value=$id>$nama</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                      <label class="form-label fw-bold fs13">QR</label>
                      <input type="text" class="form-control fupdate" form="editForm" name="qrcodee" id="qrcodee">
                      <div id="inv-desc" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12" id="inputgambar">
                    <label class="form-label fw-bold fs13">Gambar</label>
                    <input type="file" class="form-control fupdate" onchange="previewEdit()" form="editForm" name="gambare" id="gambare" accept="jpg">
                    <div id="inv-img" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <img id="img-previewe" style="width: 50%;" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" form="editForm" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="deleteProduct()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetEdit()">Batal</button>
              </div>
            </div>
          </div>
        </div>
        <!-- IMAGE MODAL -->
        <div class="modal fade" role="dialog" id="imagemodal"  tabindex="-1" data-bs-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 id="productName" class="modal-title fs-5"></h1>
              </div>
              <div class="modal-body">
                <img id="productImage" class="center">
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= BASE; ?>writable/assets/js/jquery-3.7.0.js"></script>
  <script src="<?= BASE; ?>writable/assets/js/bootstrap.min.js"></script>
  <script src="<?= BASE; ?>writable/assets/js/jquery.dataTables.min.js"></script>
  <script src="<?= BASE; ?>writable/assets/js/dataTables.bootstrap5.min.js"></script>
  <script src="<?= BASE; ?>writable/assets/sweetalert2.min.js"></script>
  <script>
    let table = $("#tbproduct").DataTable({
      "ajax": "<?= BASE; ?>showproduct",
      "createdRow": (row) =>{
        $(row).css('vertical-align', 'middle')
      },
      "columnDefs": [
        {
          "targets": [2, 3],
          "render": (data, type, row) => {
            let harga = `Rp${parseFloat(data).toLocaleString('id-ID', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 2
            }).replace(/\.\d+Rp/, '')}`;
            return harga;
          },
          "type": "numeric"
        },
        {"targets": 6, "className": "rata-tengah"},
      ],
    });

    function req($url, $data, $headers) {
      if($headers === undefined) {
        return fetch($url, {method: 'POST', body: $data})
      } else {
        return fetch($url, {method: 'POST', headers: $headers, body: $data})
      }
    }

    function swal($title, $text, $icon, $confirm = true, $timer = 0) {
      Swal.fire({title: $title, text: $text, icon: $icon, showConfirmButton: $confirm, timer: $timer});
    }

    $("#addForm").submit((e) => {
      e.preventDefault();
      const form = document.getElementById('addForm');
      const formData = new FormData(form);
      req('<?= BASE; ?>addproduct', formData)
        .then(response => {
          if(!response.ok) {
            swal('Gagal', 'Gagal terkoneksi', 'eror');
          }
          return response.json();
        })
        .then(data => {
          if(data.success) {
            swal('Berhasil', data.msg, 'success', false, 1000);
            resetAdd();
            table.ajax.reload();
          } else {
            const err = data.msg;
            if(typeof err == 'object') {
              $.each(err, (key, value) => {
                let input = $('[name="' + key + '"]');
                input.addClass('is-invalid');
                input.siblings('.invalid-feedback').html(value);
                handleInput();
              });
            } else if(typeof err == 'string') {
              swal('Gagal', data.msg, 'error');
            } else {
              swal('Gagal', 'Gagal terkoneksi', 'error');
            }
          }
        })
        .catch(err => console.error('Error caught: ', err));
    })

    $("#editForm").submit((e) => {
      e.preventDefault();
      const form = document.getElementById('editForm');
      const formData = new FormData(form);
      req('<?= BASE; ?>editproduct', formData)
        .then(response => {
          if(!response.ok) {
            swal('Gagal','Gagal terkoneksi','error');
          }
          return response.json();
        })
        .then(data => {
          if(data.success) {
            swal('Berhasil', data.msg, 'success', false, 1000);
            resetEdit();
            $("#updatemodal").modal("hide");
            table.ajax.reload(null, false);
          } else {
            const err = data.msg;
            if(typeof err == 'object') {
              $.each(err, (key, value) => {
                let input = $('[name="' + key + '"]');
                input.addClass('is-invalid');
                input.siblings('.invalid-feedback').html(value);
                handleInput();
              });
            } else if(typeof err == 'string') {
              swal('Gagal',data.msg,'error');
            } else {
              swal('Gagal','Gagal terkoneksi','error');
            }
          }
        })
        .catch(err => console.error('Error caught: ', err));
    });

    function resetAdd()
    {
      $(".fadd").val("");
      $(".cboadd").val("default").change();
      $(".fadd").removeClass('is-invalid');
      $(".cboadd").removeClass('is-invalid');
      $(".invalid-feedback").html('');
      $("#img-preview").attr('src', 'writable/assets/img/default.svg');
    }

    function filter(e)
    {
      let id = $(e).data("id");
      if(id == "") {
        swal('Gagal', 'Data tidak terdeteksi', 'error');
        return; 
      }
      req('<?= BASE; ?>getproduct', JSON.stringify({idx: id}), {'Content-Type': 'application/json'})
        .then(response => {
          if(!response.ok) {
            alert('Gagal','Gagal tekoneksi','error');
          }
          return response.json();
        })
        .then(data => {
          if(data.success){
            const dt = data.msg;
            $("#ide").val(id);
            $("#idee").val(id);
            $("#namae").val(dt.nama);
            $("#hbelie").val(dt.hbeli);
            $("#hjuale").val(dt.hjual);
            $("#satuane").val(dt.satuan).change();
            $("#kategorie").val(dt.kategori).change();
            $("#qrcodee").val(dt.qrcode);
            $("#updatemodal").modal('show');
            const path = 'writable/assets/img/'
            if(dt.file != '') {
              $('#img-previewe').attr('src', `writable/uploads/${dt.file}`);
            } else {
              switch(dt.kategori){
                case '01': $("#img-previewe").attr('src', path + 'burger.svg'); break;
                case '02': $("#img-previewe").attr('src', path + 'coke.svg'); break;
                case '03': $("#img-previewe").attr('src', path + 'cleaning-mop.svg'); break;
                case '04': $("#img-previewe").attr('src', path + 'cosmetics.svg'); break;
                case '05': $("#img-previewe").attr('src', path + 'list.svg'); break;
                case '06': $("#img-previewe").attr('src', path + 'fatherhood.svg'); break;
                case '07': $("#img-previewe").attr('src', path + 'cooking-stew.svg'); break;
                case '08': $("#img-previewe").attr('src', path + 'wash.svg'); break;
                case '09': $("#img-previewe").attr('src', path + 'smartphone-touch-screen.svg'); break;
                case '10': $("#img-previewe").attr('src', path + 'ice-cream.svg'); break;
                default: $("#img-previewe").attr('src', 'writable/assets/img/default.svg')
              }
            }
          } else {
            throw({title: 'Gagal', text: 'Koneksi Gagal', icon: 'error'});
          }
        })
        .catch(err => console.error('Error caught: ', err));
    }

    function resetEdit()
    {
      $(".fupdate").val("");
      $(".cboupdate").val("").change();
      $(".fupdate").removeClass('is-invalid');
      $(".cboupdate").removeClass('is-invalid');
      $(".invalid-feedback").html('');
    }

    function deleteProduct()
    {
      let id = $("#ide").val();
      if(id == ""){
        swal('Gagal', 'ID produk masih kosong', 'error');
        return;
      }
      
      Swal.fire(
        {
          title: 'Konfirmasi',
          text: 'Anda yakin??',
          icon: 'warning',
          showCancelButton: true,
          cancelButtonColor: "#d33",
          confirmButtonColor: "green",
          confirmButtonText: 'Yakin',
          cancelButtonText: 'Tidak',
        }
      ).then((res) => {
        if(res.isConfirmed){
          req('<?= BASE; ?>deleteproduct', JSON.stringify({idx: id}), {'Content-Type': 'application/json'})
            .then(response => {
              if(!response.ok) {
                swal('Gagal','Gagal terkoneksi','error');
              }
              return response.json();
            })
            .then(data => {
              if(data.success) {
                swal('Berhasil',data.msg,'success',false,1000);
                resetEdit();
                table.ajax.reload();
                $("#updatemodal").modal("hide");
              } else {
                swal('Gagal',data.msg,'error');
              }
            })
            .catch(err => console.error('Error caught: ', err));
        }
      })
    }

    function openimage(e)
    {
      let path = $(e).attr('src');
      let name = $(e).data("nama");
      $('#productImage').attr('src', path);
      $('#productName').html(name);
      $("#imagemodal").modal('show');
    }

    function previewAdd()
    {
      const preview = $("#img-preview");
      const ktg = $("#kategori").val();
      const path = 'writable/assets/img/';
      if($("#gambar").val() == ''){
        switch(ktg){
          case '01': $("#img-preview").attr('src', path + 'burger.svg'); break;
          case '02': $("#img-preview").attr('src', path + 'coke.svg'); break;
          case '03': $("#img-preview").attr('src', path + 'cleaning-mop.svg'); break;
          case '04': $("#img-preview").attr('src', path + 'cosmetics.svg'); break;
          case '05': $("#img-preview").attr('src', path + 'list.svg'); break;
          case '06': $("#img-preview").attr('src', path + 'fatherhood.svg'); break;
          case '07': $("#img-preview").attr('src', path + 'cooking-stew.svg'); break;
          case '08': $("#img-preview").attr('src', path + 'wash.svg'); break;
          case '09': $("#img-preview").attr('src', path + 'smartphone-touch-screen.svg'); break;
          case '10': $("#img-preview").attr('src', path + 'ice-cream.svg'); break;
          default: $("#img-preview").attr('src', 'writable/assets/img/default.svg')
        }
      }
      const file = new FileReader();
      const img = $("#gambar").prop('files')[0];
      const read = file.readAsDataURL(img);
      file.onload = (e) => {
        preview.attr('src', e.target.result);
      }
    }

    function previewEdit()
    {
      const preview = $("#img-previewe");
      const ktg = $("#kategorie").val();
      const path = 'writable/assets/img/';
      if($("#gambare").val() == ''){
        switch(ktg){
          case '01': $("#img-previewe").attr('src', path + 'burger.svg'); break;
          case '02': $("#img-previewe").attr('src', path + 'coke.svg'); break;
          case '03': $("#img-previewe").attr('src', path + 'cleaning-mop.svg'); break;
          case '04': $("#img-previewe").attr('src', path + 'cosmetics.svg'); break;
          case '05': $("#img-previewe").attr('src', path + 'list.svg'); break;
          case '06': $("#img-previewe").attr('src', path + 'fatherhood.svg'); break;
          case '07': $("#img-previewe").attr('src', path + 'cooking-stew.svg'); break;
          case '08': $("#img-previewe").attr('src', path + 'wash.svg'); break;
          case '09': $("#img-previewe").attr('src', path + 'smartphone-touch-screen.svg'); break;
          case '10': $("#img-previewe").attr('src', path + 'ice-cream.svg'); break;
          default: $("#img-previewe").attr('src', 'writable/assets/img/default.svg')
        }
      }
      const file = new FileReader();
      const img = $("#gambare").prop('files')[0];
      const read = file.readAsDataURL(img);
      file.onload = (e) => {
        preview.attr('src', e.target.result);
      }
    }
    
    function handleInput()
    {  
      $('input, select').on('input', function(){
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').html('');
      });
    }

    function imgpreviewedit()
    {
      let ktg = $("#kategorie").val();
      let id = $("#ide").val();
      let img = $("#img-previewe").attr('src');
      let poto = $("#gambare").val()
      const path = 'writable/assets/img/';
      if(poto == '') {
        if(img != 'writable/uploads/' + id + '.jpg'){
          switch(ktg){
            case '01': $("#img-previewe").attr('src', path + 'burger.svg'); break;
            case '02': $("#img-previewe").attr('src', path + 'coke.svg'); break;
            case '03': $("#img-previewe").attr('src', path + 'cleaning-mop.svg'); break;
            case '04': $("#img-previewe").attr('src', path + 'cosmetics.svg'); break;
            case '05': $("#img-previewe").attr('src', path + 'list.svg'); break;
            case '06': $("#img-previewe").attr('src', path + 'fatherhood.svg'); break;
            case '07': $("#img-previewe").attr('src', path + 'cooking-stew.svg'); break;
            case '08': $("#img-previewe").attr('src', path + 'wash.svg'); break;
            case '09': $("#img-previewe").attr('src', path + 'smartphone-touch-screen.svg'); break;
            case '10': $("#img-previewe").attr('src', path + 'ice-cream.svg'); break;
            default: $("#img-previewe").attr('src', 'writable/assets/img/default.svg');
          }
        }
      }
    }

    function imgpreviewadd()
    {
      let ktg = $("#kategori").val();
      let img = $("#gambar").val();
      const path = 'writable/assets/img/';
      if(img == ''){
        switch(ktg){
          case '01': $("#img-preview").attr('src', path + 'burger.svg'); break;
          case '02': $("#img-preview").attr('src', path + 'coke.svg'); break;
          case '03': $("#img-preview").attr('src', path + 'cleaning-mop.svg'); break;
          case '04': $("#img-preview").attr('src', path + 'cosmetics.svg'); break;
          case '05': $("#img-preview").attr('src', path + 'list.svg'); break;
          case '06': $("#img-preview").attr('src', path + 'fatherhood.svg'); break;
          case '07': $("#img-preview").attr('src', path + 'cooking-stew.svg'); break;
          case '08': $("#img-preview").attr('src', path + 'wash.svg'); break;
          case '09': $("#img-preview").attr('src', path + 'smartphone-touch-screen.svg'); break;
          case '10': $("#img-preview").attr('src', path + 'ice-cream.svg'); break;
          default: $("#img-preview").attr('src', 'writable/assets/img/default.svg');
        }
      }
    }
  </script>
</body>
</html>