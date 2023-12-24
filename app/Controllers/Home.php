<?php

namespace App\Controllers;
use App\Models\Mdata;
use App\Models\ProductsModel;

class Home extends BaseController
{
  
  public function index()
  {
    $x["satuan"] = $this->Mdata->getSatuan();
    $x["kategori"] = $this->Mdata->getKategori();
    return view('home', $x);
  }

  
  public function showProduct()
  {
    $dtJSON = '{"data": [xxx]}';
    $dtisi = "";
    $dt = $this->Mdata->showProduct();
    foreach ($dt as $key) {
      $id = $key->id;
      $nama = $key->nama;
      $hargabeli = $key->hargabeli;
      $hargajual = $key->hargajual;
      $satuan = $key->satuan;
      $kategori = $key->kategori;
      $path = 'writable/uploads/';
      $asset = 'writable/assets/img/';
      $gambar = '';
      if(!file_exists($path . $id . '.jpg')){
        switch($kategori){
          case "Makanan":
            $gambar = $asset . 'burger.svg';
            break;
          case "Minuman":
            $gambar = $asset . 'coke.svg';
            break;
          case "Peralatan Rumah Tangga":
            $gambar = $asset . 'cleaning-mop.svg';
            break;
          case "Kosmetik":
            $gambar = $asset . 'cosmetics.svg';
            break;
          case "Alat Tulis Kantor":
            $gambar = $asset . 'list.svg';
            break;
          case "Keperluan Bayi":
            $gambar = $asset . 'fatherhood.svg';
            break;
          case "Bahan Masakan":
            $gambar = $asset . 'cooking-stew.svg';
            break;
          case "Sabun":
            $gambar = $asset . 'wash.svg';
            break;
          case "Barang Digital":
            $gambar = $asset . 'smartphone-touch-screen.svg';
            break;
          case "Ice Cream":
            $gambar = $asset . 'ice-cream2.svg';
            break;
          default:
          $gambar = $asset . 'default.svg';
        }
      } else {
        $gambar = 'writable/uploads/' . $id  . '.jpg';
      }
      $gambar = sprintf("<img src='%s' data-nama='%s' style='height: 75px; cursor: pointer;' onclick='openimage(this)' />", $gambar, $nama);
      $tombolkelola = sprintf("<button type='button' class='btn btn-primary' data-id='%s' onclick='filter(this)'>Kelola</button>", $id);
      $dtisi .=  sprintf('["%s","%s","%s","%s","%s","%s","%s","%s"],', $id,$nama,$hargabeli,$hargajual,$satuan,$kategori,$gambar,$tombolkelola);
    }
    $dtisifix = rtrim($dtisi, ",");
    $data = str_replace("xxx",$dtisifix, $dtJSON);
    echo $data;
  }

  public function addProduct()
  {
    $validation = \Config\Services::validation();
    $validation->setRules([
      'id'    => [
        'rules' => 'required|is_unique[barang.id]',
        'errors' => [
          'required' => 'Isi ID produk!',
          'is_unique' => 'ID produk sudah terdaftar'
        ]
      ],
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi nama produk!'
        ]
      ],
      'hbeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi harga beli!'
        ]
      ],
      'hjual' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi harga jual!'
        ]
      ],
      'satuan' => [
        'rules' => 'in_list[01,02,03,04,05,06]',
        'errors' => [
          'in_list' => 'Pilih satuan produk!'
        ]
      ],
      'kategori' => [
        'rules' => 'in_list[01,02,03,04,05,06,07,08,09,10]',
        'errors' => [
          'in_list' => 'Pilih kategori produk!'
        ]
      ],
      'qrcode' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi qrcode produk!'
        ]
      ],
      'gambar' => [
        'rules' => 'is_image[gambar]',
        'errors' => [
          'is_image' => 'Pilih gambar ekstensi (.jpg)',
          'ext_in' => 'Pilih gambar ekstensi (.jpg)',
        ]
      ]
    ]);
    if(!$validation->run($_POST)){
      $errors = $validation->getErrors();
      return $this->setResponse(false, $errors);
    }

    $id = $this->request->getPost('id');
    $nama = $this->request->getPost('nama');
    $hbeli = $this->request->getPost('hbeli');
    $hjual = $this->request->getPost('hjual');
    $satuan = $this->request->getPost('satuan');
    $kategori = $this->request->getPost('kategori');
    $qrcode = $this->request->getPost('qrcode');
    $gambar = $this->request->getFile('gambar');
    if($gambar->getError() != 4){
      $file = $id . '.jpg';
      $gambar->move(ROOTPATH . 'writable/uploads', $file);
    }

    $dt = $this->Mdata->addProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode);
    return $dt == '1' ? $this->setResponse(true, 'Data Berhasil Ditambahkan') : $this->setResponse(false, 'Data Gagal Ditambahkan'); 
  }

  public function getProduct()
  {
    $id = $this->request->getVar('idx');
    $dt = $this->Mdata->getProduct($id);
    foreach($dt as $x){
      $nama = $x->nama;
      $hbeli = $x->hargabeli;
      $hjual = $x->hargajual;
      $satuan = $x->satuan;
      $kategori = $x->kategori;
      $qrcode = $x->qr;
      $path = 'writable/uploads/' . $id . '.jpg';
      $file = '';
      if(file_exists($path)){
        $file = $id . '.jpg';
      }
      
      return $this->response->setJSON(
        [
          'success'   => true,
          'nama'      => $nama,
          'hbeli'     => $hbeli,
          'hjual'     => $hjual,
          'satuan'    => $satuan,
          'kategori'  => $kategori,
          'qrcode'    => $qrcode,
          'file'      => $file,
        ]
      );
    }
  }

  public function editProduct()
  {

    $rule = '';
    $idLama = $this->request->getVar('ide');
    $id = $this->request->getVar('idee');

    if($idLama == $id){
      $rule = 'required';
    } else {
      $rule = 'required|is_unique[barang.id]';
    }

    $validation = \Config\Services::validation();
    $validation->setRules([
      'ide'    => [
        'rules' => $rule,
        'errors' => [
          'required' => 'Isi ID produk!',
          'is_unique' => 'ID produk sudah terdaftar!'
        ]
      ],
      'namae' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi nama produk!'
        ]
      ],
      'hbelie' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi harga beli!'
        ]
      ],
      'hjuale' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi harga jual!'
        ]
      ],
      'satuane' => [
        'rules' => 'in_list[01,02,03,04,05,06]',
        'errors' => [
          'in_list' => 'Pilih satuan produk!'
        ]
      ],
      'kategorie' => [
        'rules' => 'in_list[01,02,03,04,05,06,07,08,09,10]',
        'errors' => [
          'in_list' => 'Pilih kategori produk!'
        ]
      ],
      'qrcodee' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi qrcode produk!'
        ]
      ],
      'gambare' => [
        'rules' => 'is_image[gambare]',
        'errors' => [
          'is_image' => 'Pilih gambar ekstensi (.jpg)',
        ]
      ]
    ]);

    if(!$validation->run($_POST)){
      $errors = $validation->getErrors();
      return $this->setResponse(false, $errors);
    }

    $id         = $this->request->getPost('ide');
    $nama       = $this->request->getPost('namae');
    $hbeli      = $this->request->getPost('hbelie');
    $hjual      = $this->request->getPost('hjuale');
    $satuan     = $this->request->getPost('satuane');
    $kategori   = $this->request->getPost('kategorie');
    $qrcode     = $this->request->getPost('qrcodee');
    $gambar     = $this->request->getFile('gambare');
    $path       = 'writable/uploads/' . $id . '.jpg';
    if($gambar->getError() != 4){
      if(file_exists($path)){
        unlink($path);
      }
      $file = $id . '.jpg';
      $gambar->move(ROOTPATH . 'writable/uploads', $file);
    }
    $dt = $this->Mdata->updateProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode);
    return $dt == '1' ? $this->setResponse(true, 'Data berhasil diubah!') : $this->setResponse(false, 'Data gagal diubah!');
  }

  public function deleteProduct()
  {
    $id = $this->request->getVar('idx');
    $dt = $this->Mdata->deleteProduct($id);
    if(file_exists('writable/uploads/' . $id . '.jpg')){
      unlink('writable/uploads/' . $id . '.jpg');
    }
    return $dt == '1' ? $this->setResponse(true, 'Data berhasil dihapus') : $this->setResponse(false, 'Data gagal dihapus');
  }

  public function uploadImage()
  {
    if($this->request->getMethod() === 'post' && $this->validate(['image' => 'uploaded[image]|is_image[image]'])) {
      $image = $this->request->getFile('image');
      
      if ($image->isValid() && !$image->hasMoved()){
          $image->move(ROOTPATH . 'writable/uploads');
          $filename = $image->getname();
          $filepath = 'writable/uploads/' . $filename;
          $x = 'berhasil diupload';        
          return $x;
      } else {
          echo '{"kode":"2","pesan":"Gambar gagal diupload"}';
      }
    } else {
        echo '{"kode":"3","pesan":"Format file salah!"}';
    }
  }

  public function formData()
  {
    return view('formdata');
  }

  public function cobaForm()
  {
    $nama = $this->request->getPost('username');
    $path = $this->request->getVar('pathx');
    $data = sprintf('{"kode":"1","nama":"%s","path":"%s"}', $nama, $path);
    echo $data;
  }
}
