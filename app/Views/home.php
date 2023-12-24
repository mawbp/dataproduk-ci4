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
            <button class="btn btn-success">Cetak Excel</button>
            <button class="btn btn-danger">Cetak PDF</button>
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
        <div class="modal fade" id="addmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs20">Tambah Produk</h5>
              </div>
              <form id="addForm"></form>
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
                      <option value="default">--Pilih tipe--</option>
                      <option value="01">Bijian</option>
                      <option value="02">Kardus</option>
                      <option value="03">Kilogram</option>
                      <option value="04">Liter</option>
                      <option value="05">Ons</option>
                      <option value="06">Renteng</option>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Kategori</label>
                    <select class="form-select cboadd" form="addForm" name="kategori" id="kategori" oninput="imgpreviewadd()">
                      <option value="default">--Pilih tipe--</option>
                      <option value="01">Makanan</option>
                      <option value="02">Minuman</option>
                      <option value="03">Peralatan Rumah Tangga</option>
                      <option value="04">Kosmetik</option>
                      <option value="05">Alat Tulis Kantor</option>
                      <option value="06">Peralatan Bayi</option>
                      <option value="07">Bahan Masakan</option>
                      <option value="08">Sabun</option>
                      <option value="09">Barang Digital</option>
                      <option value="10">Ice Cream</option>
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
        <div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs20">Update Produk</h5>
              </div>
              <form id="editForm"></form>
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
                      <option value="01">Bijian</option>
                      <option value="02">Kardus</option>
                      <option value="03">Kilogram</option>
                      <option value="04">Liter</option>
                      <option value="05">Ons</option>
                      <option value="06">Renteng</option>
                    </select>
                    <div id="inv-type" class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label fw-bold fs13">Kategori</label>
                    <select class="form-select cboupdate" form="editForm" name="kategorie" id="kategorie" oninput="imgpreviewedit()">
                      <option>--Pilih tipe--</option>
                      <option value="01">Makanan</option>
                      <option value="02">Minuman</option>
                      <option value="03">Peralatan Rumah Tangga</option>
                      <option value="04">Kosmetik</option>
                      <option value="05">Alat Tulis Kantor</option>
                      <option value="06">Peralatan Bayi</option>
                      <option value="07">Bahan Masakan</option>
                      <option value="08">Sabun</option>
                      <option value="09">Barang Digital</option>
                      <option value="10">Ice Cream</option>
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
                    <input type="file" class="form-control fupdate" onchange="previewEdit()" form="editForm" name="gambare" id="gambare" accept="">
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
                <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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
  <script  type="text/javascript">
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

    $("#addForm").submit((e) => {
      e.preventDefault();
      const form = document.getElementById('addForm');
      const formData = new FormData(form);
      $.ajax(
        {
          url: '<?= BASE; ?>addproduct',
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          cache: 'false',
          success: (res) => {
            if(res.success){
              Swal.fire(
                {
                  title: 'Berhasil',
                  text: res.msg,
                  showConfirmButton: false,
                  icon: 'success',
                  timer: 1000
                }
              );
              resetAdd();
              table.ajax.reload();
            } else {
              const err = res.msg;
              $.each(err, (key, value) => {
                let input = $('[name="' + key + '"]');
                input.addClass('is-invalid');
                input.siblings('.invalid-feedback').html(value);
                handleInput();
              });
            }
          },
          error: (res) => {
            Swal.fire(
              {
                title: 'Gagal',
                text: 'Koneksi ke Controller Gagal',
                icon: 'error',
              }
            )
            console.log(res);
          }
        }
      )
    })

    $("#editForm").submit((e) => {
      e.preventDefault();
      const form = document.getElementById('editForm');
      const formData = new FormData(form)
      $.ajax(
        {
          url: '<?= BASE; ?>editproduct',
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          cache: 'false',
          success: (res) => {
            if(res.success){
              Swal.fire(
                {
                  title: 'Berhasil',
                  text: res.msg,
                  showConfirmButton: false,
                  icon: 'success',
                  timer: 1000
                }
              );
              resetEdit();
              $("#updatemodal").modal("hide");
              table.ajax.reload(null, false);
            } else {
              const err = res.errors;
              $.each(err, (key, value) => {
                let input = $('[name="' + key + '"]');
                input.addClass('is-invalid');
                input.siblings('.invalid-feedback').html(value);
                handleInput();
              });
            }
          },
          error: () => {
            Swal.fire(
              {
                title: 'Gagal',
                text: 'Koneksi ke Controller Gagal',
                icon: 'error'
              }
            );
          }
        }
      )
    })

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
        Swal.fire(
          {
            title: 'Gagal',
            text: 'Data tidak terdeteksi',
            icon: 'error'
          }
        )
        return; 
      }
      $.ajax(
        {
          url: '<?= BASE; ?>getproduct',
          method: 'POST',
          data: {idx: id},
          cache: 'false',
          success: (res) => {
            if(res.success){
              $("#ide").val(id);
              $("#idee").val(id);
              $("#namae").val(res.nama);
              $("#hbelie").val(res.hbeli);
              $("#hjuale").val(res.hjual);
              $("#satuane").val(res.satuan).change();
              $("#kategorie").val(res.kategori).change();
              $("#qrcodee").val(res.qrcode);
              $("#updatemodal").modal('show');
              const path = 'writable/assets/img/';
              if(res.file != ''){
                $("#img-previewe").attr('src', `writable/uploads/${res.file}`);
              } else {
                switch(res.kategori){
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
              Swal.fire(
                {
                  title: 'Gagal',
                  text: data.pesan,
                  icon: 'error',
                }
              );
            }
          },
          error: () => {
            Swal.fire(
              {
                title: 'Gagal',
                text: 'Koneksi ke Controller gagal',
                icon: 'error',
              }
            );
          }
        }
      )
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
        Swal.fire(
          {
            title: 'Gagal',
            text: 'ID produk masih kosong',
            icon: 'error',
          }
        );
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
          $.ajax(
            {
              url: '<?= BASE; ?>deleteproduct',
              method: 'POST',
              data: {idx: id},
              cache: 'false',
              success: (res) => {
                if(res.success){
                  Swal.fire(
                    {
                      title: 'Berhasil',
                      text: res.msg,
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                    }
                  );
                  resetEdit();
                  table.ajax.reload();
                  $("#updatemodal").modal("hide");
                } else {
                  Swal.fire(
                    {
                      title: 'Gagal',
                      text: res.msg,
                      icon: 'error',
                    }
                  )
                }
              },
              error: () => {
                Swal.fire(
                  {
                    title: 'Gagal',
                    text: 'Koneksi ke controller gagal',
                    icon: 'error',
                  }
                )
              }
            }
          )
        }
      })
    }

    function cobak()
    {
      let data = new FormData(this);
      console.log(data);
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

    function inputgambar()
    {
      const ktg = $("#kategorie").val();
      const path = 'writable/assets/img/';
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
      $("#tombolinputgambar").hide();
      $("#img-previewe").show();
      $("#inputgambar").show();
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
      const path = 'writable/assets/img/';
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