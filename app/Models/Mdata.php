<?php

namespace App\Models;
use CodeIgniter\Model;

class Mdata extends Model {

  public function showProduct()
  {
    $sql = "SELECT barang.id, barang.nama, hargabeli, hargajual, satuan.nama AS satuan, kategori.nama AS kategori FROM barang LEFT JOIN satuan ON barang.id_satuan = satuan.id LEFT JOIN kategori ON barang.id_kategori = kategori.id";
    $dt = db_connect()->query($sql);
    return $dt ? $dt->getResult() : 0; 
  }

  public function getProduct($id)
  {
    $sql = "SELECT id, nama, hargabeli, hargajual, id_satuan AS satuan, id_kategori AS kategori, qr FROM barang WHERE id = '$id'";
    $dt = db_connect()->query($sql);
    return $dt ? $dt->getResult() : 0;
  }

  public function getProductApi($qr)
  {
    $sql = "SELECT barang.id, barang.nama, hargabeli, hargajual, satuan.nama AS satuan, kategori.nama AS kategori, qr FROM barang LEFT JOIN satuan ON barang.id_satuan = satuan.id LEFT JOIN kategori ON barang.id_kategori = kategori.id WHERE qr = '$qr'";
    $dt = db_connect()->query($sql);
    return $dt ? $dt->getResult() : 0;
  }

  public function addProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode)
  {
    $sql = "INSERT INTO barang VALUES('$id','$nama','$hbeli','$hjual','$satuan','$kategori','$qrcode','')";
    $dt = db_connect()->query($sql);
    return $dt ? '1' : '0';
  }

  public function updateProduct($id,$nama,$hbeli,$hjual,$satuan,$kategori,$qrcode)
  {
    $sql = "UPDATE barang SET nama = '$nama', hargabeli = '$hbeli', hargajual = '$hjual', id_satuan = '$satuan', id_kategori = '$kategori', qr = '$qrcode' WHERE id = '$id'";
    $dt = db_connect()->query($sql);
    return $dt ? '1' : '0';
  }

  public function  deleteProduct($id)
  {
    $sql = "DELETE FROM barang WHERE id = '$id'";
    $dt = db_connect()->query($sql);
    return $dt ? '1' : '0';
  }
}
