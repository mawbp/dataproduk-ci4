<?php

namespace App\Models;
use CodeIgniter\Model;
class ProductsModel extends Model {
  protected $table = 'barang';
  protected $allowedFields = ['id','nama','hargabeli','hargajual','id_satuan','id_kategori','qr','keterangan'];

  public function getProduct($id = false)
  {
    if($id == false){
      return "0";
    }

    return $this->where('id', $id)
                ->get()
                ->getResult();
  }

  public function updateProduct($id, $data)
  {
    $this->where('id', $id)
         ->update($data);
    
    return "1";
  }
}
