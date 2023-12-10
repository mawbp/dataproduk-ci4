<?php

namespace App\Controllers;
use App\Models\Mdata;
use App\Models\ProductsModel;

class Api extends BaseController
{

  public function index()
  {
    $dt = $this->Mdata->showProduct();
    echo json_encode($dt);
    // echo json_encode(["success" => true, "pesan" => "API CI4 Berhasil!"]);
  }

  public function tambah()
  {
    $id = $this->request->getVar("id");
    $nama = $this->request->getVar("nama");
    $hbeli = $this->request->getVar("hbeli");
    $hjual = $this->request->getVar("hjual");
    $satuan = $this->request->getVar("satuan");
    $kategori = $this->request->getVar("kategori");
    $qrcode = $this->request->getVar("qr");
    $gambar = $this->request->getFile("gambar");
    if($gambar != ''){
      $file = $id . '.jpg';
      $gambar->move(ROOTPATH . 'writable/uploads', $file);
    }
    $dt = $this->Mdata->addProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode);
    echo $dt == '1' ? json_encode(["success" => true, "message" => "Produk berhasil ditambahkan"]) : json_encode(["success" => true, "message" => "Produk gagal ditambahkan"]);
  }

  public function cari()
  {
    $qr = $this->request->getVar("qr");
    $dt = $this->Mdata->getProductApi($qr);
    echo json_encode($dt);
  }

  public function hapus()
  {
    $id = $this->request->getVar("id");
    $file = 'writable/uploads/' . $id . '.jpg';
    if(file_exists($file)){
      unlink($file);
    }
    $dt = $this->Mdata->deleteProduct($id);
    echo $dt == '1' ? json_encode(["success" => true, "message" => "Produk berhasil dihapus"]) : json_encode(["success" => false, "message" => "Produk gagal dihapus"]); 
  }

  public function edit()
  {
    $id = $this->request->getVar("id");
    $nama = $this->request->getVar("nama");
    $hbeli = $this->request->getVar("hbeli");
    $hjual = $this->request->getVar("hjual");
    $satuan = $this->request->getVar("satuan");
    $kategori = $this->request->getVar("kategori");
    $qrcode = $this->request->getVar("qr");
    $gambar = $this->request->getFile("gambar");
    $file = 'writable/uploads/' . $id . '.jpg';
    if($gambar == ''){
      if(file_exists($file)){
        unlink($file);
      }
    } else {
      $file = $id . '.jpg';
      $gambar->move(ROOTPATH . 'writable/uploads', $file);
    }
    $dt = $this->Mdata->updateProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode);
    echo $dt == '1' ? json_encode(["success" => true, "message" => "Produk berhasil diubah"]) : json_encode(["success" => false, "message" => "Produk gagal diubah"]);
  }
}
