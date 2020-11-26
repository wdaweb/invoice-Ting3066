<?php
include_once "base.php";


// 取得單一資料的自訂函式
function find($table,$id){
  global $pdo;
  //判斷id是否為數字
  if(is_array($id)){

    foreach($id as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
      // $tmp[]="`".$key."`='".$value."'";
    }

    $sql="select * from $table where ".implode(" && ",$tmp);
  }else{
    $sql="select * from $table where id='$id'";
    
  }

  $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  return $row;

}

//update()函式，更新資料
function update($table,$array){
  global $pdo;
  $sql="update $table set ";
  foreach($array as $key => $value){

    //如果選出的欄位名稱不是id的時候才會產生字串在set的欄位，因為id不用做更改
    if($key!='id'){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);

    }
  }

  $sql=$sql.implode(",",$tmp)."where `id`='{$array['id']}'";
  echo $sql;
  $pdo->exec($sql);



}

//insert()函式，新增資料
function insert($table,$array){
  global $pdo;
  $sql="insert into $table(`".implode("`,`",array_keys($array))."`) values('".implode("','",$array)."') ";



  $pdo->exec($sql);
}

//save()函式，將update()跟insert()合併，判斷使用時機
function save($table,$array){
  
  if(isset($array['id'])){
    //update
    update($table,$array);
  }else{
    //insert
    insert($table,$array);
  }
}



//利用find()函式找到id=22的資料
$row=find('invoices',22);
// echo "<pre>";
// print_r($row);
// echo "</pre>";

//將$row的欄位資料做修改
$row['code']='BB';
$row['payment']=1;

//再用update()函式將修改的資料寫入資料庫中，完成更改
update('invoices',$row);
















//arg 為一陣列型態，即使為空值型態依舊是陣列，且程式照樣執行
// function all($table,...$arg){
//   global $pdo;

//   $sql="select * from $table ";
//   if(isset($arg[0])){
//     if(is_array($arg[0])){
//       //製作會在where 號面的句子字串
//       if(!empty($arg[0])){
//         foreach($arg[0] as $key => $value){
//           $tmp[]=sprintf("`%s`='%s'",$key,$value);
//           // $tmp[]="`".$key."`='".$value."'";
//         }

//         $sql=$sql." where ".implode(" && ",$tmp);
//       }
  
//     }else{
  
//         $sql=$sql.$arg[0];
  
  
//     }
//   }
  
//   if(isset($arg[1])){
//     //製作接在最後面的句子字串
//     $sql=$sql.$arg[1];


//   }
//   echo $sql."<br>";

//   return $pdo->query($sql)->fetchALL();
//   function del($table,$id){
//     $sql="delete * from $table where ";
//     if(is_array($id)){
//         foreach($id as $key => $value){
//           $tmp[]=sprintf("`%s`='%s'",$key,$value);
//         }

//         $sql=$sql.implode(" && ",$tmp);
  
//     }else{
  
//         $sql=$sql." id='$id' ";
  
  
//     }
//     $row=$pdo->exec($sql);
//     return $row;
//   }
//   $def=['code'=>'GD'];
//   echo del('invoices',$def);
// }


// echo "<hr>";
// all('invoices');
// echo "<hr>";
// all('invoices',['code'=>"KJ",'period'=>6]);
// echo "<hr>";
// all('invoices',['code'=>"AB",'period'=>1]," order by date desc");
// echo "<hr>";
// all('invoices'," limit 5");
// echo "<hr>";
// print_r(all('invoices'));
// echo "<hr>";
// print_r(all('invoices',['code'=>"GD",'period'=>6]));
// echo "<hr>";
// print_r(all('invoices',['code'=>"AB",'period'=>1," order by date desc"]));
// echo "<hr>";
// print_r(all('invoices',"limit 5"));
?>