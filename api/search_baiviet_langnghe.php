<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    require_once 'connect.php';
    $tenDanhMuc = $_POST['tenDanhMuc'];
    $key = $_POST['key'];
    if(password_verify("dulichhaiphong", $key)){
       class BaiVietChua
    {
        
        function BaiVietChua($id,$tenbaiviet,$tomtat,$anhdaidien,$solike,$ngaydang,$noidung)
        {
            $this->Id = $id;
            $this->TenBaiViet=$tenbaiviet;
            $this->TomTat=$tomtat;
            $this->AnhDaiDien=$anhdaidien;
            $this->SoLike = $solike;
            $this->NgayDang = $ngaydang;
            $this->Noidung = $noidung;
        }
    }
      $sql = "SELECT baiviet.id, baiviet.TenBaiViet, baiviet.TomTat, (select COUNT(*) from likes where likes.BaiViet_id=baiviet.id) as SoLike, baiviet.ThoiGianDang, baiviet.AnhDaiDien, baiviet.NoiDung FROM baiviet inner join langnghe on baiviet.LangNghe_id = langnghe.id inner join capcongnhan on langnghe.CapCongNhan_id = capcongnhan.id WHERE capcongnhan.TenCapCongNhan LIKE ('%$tenDanhMuc%') AND baiviet.XuatBan = 1";
    $response = mysqli_query($conn, $sql);
    $result = array();
    $result['baiviet'] = array();
    if($response) {
        while ($row = mysqli_fetch_assoc($response)) {
             array_push($result["baiviet"], new BaiVietChua($row["id"],$row["TenBaiViet"],$row["TomTat"],$row["AnhDaiDien"],$row["SoLike"],$row["ThoiGianDang"],$row['NoiDung']));
        }
        $result["success"] = "1";
             echo json_encode($result);
             mysqli_close($conn);
   }else{

     $result["success"] = "0";
     $result["message"] = "Error!";
     echo json_encode($result);
     mysqli_close($conn);
    }
}
}echo "Not load page";
 ?>
