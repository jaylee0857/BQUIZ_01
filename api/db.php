<?php 
session_start();
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";

}

function to($url){
    header("location: $url");
}

class DB {
    // 1. 定義pdo連線需要的資訊
    private $dsn = "mysql:host=localhost;dbname=db01_1;charset=utf8";
    private $pdo;
    private $table;
    // 1-1. 物件建構式
    function __construct ($table) {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn,'root','');
    }
    // 2. 工具函式撰寫
    function arraytosql ($array){
        $temp=[];
        foreach($array as $key => $val){
            $temp[]="`$key` = '$val'";
        }
        return $temp;
    }
    // 3. 資料庫函式撰寫 all count find save del  sum max
    function all(...$arg){
        $sql="select * FROM {$this->table} ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $temp=$this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $temp);
                }
            else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])) {
                $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); //
    }

    function count(...$arg){
        $sql = "SELECT count(*) FROM {$this->table} ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $temp = $this->arraytosql($arg[0]);
                $sql = $sql . " WHERE " . join(" AND ", $temp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    
    function find($id){
        $sql = "SELECT * FROM $this->table ";
        if(is_array($id)){
            $temp = $this->arraytosql($id);
            $sql = $sql . " WHERE " . join(" AND ", $temp);
        }else {
            $sql .= " WHERE `id`='{$id}'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function max($col,...$arg){
        $sql = "SELECT max($col) FROM $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $temp= $this->arraytosql($arg[0]);
                $sql = $sql . " where " .join(" AND ", $temp);
            }else {
                $sql = $sql . $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql = $sql . $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col,...$arg){
        $sql="SELECT sum($col) FROM $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $temp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $temp);
            }else {
                $sql = $sql . $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
    
    function del($id){
        $sql= "DELETE FROM $this->table ";
        if(is_array($id)){
            $temp = $this->arraytosql($id);
            $sql = $sql . " where " . join(' AND ', $temp);
        }else{
            $sql.= " where `id`='{$id}'";
        }
        return $this->pdo->exec($sql);
    }


    function save($array){
        if(isset($array['id'])){
            $sql = "update $this->table set ";
            $temp=$this->arraytosql($array);
            $sql .= join(" , ", $temp) . " where `id` = '{$array['id']}'";

        }else {
            $cols=join("`,`",array_keys($array));
            $val=join("','",$array);
            $sql = "insert into $this->table (`$cols`) values ('$val')";
        }
        return $this->pdo->exec($sql);
    }

}
    $test = new DB('test_table');
    // $result=$test->arraytosql(['sh'=>'1']);

    $Title = new DB('title');                                         // 專管 title 表
    $Ad = new DB('ad');                                               // 專管 ad 表
    $Mvim = new DB('mvim');                                           // 專管 mvim 表
    $Image = new DB('image');                                         // 專管 image 表
    $News = new DB('news');                                           // 專管 news 表
    $Admin = new DB('admin');                                         // 專管 admin 表
    $Menu = new DB('menu');                                           // 專管 menu 表
    $Total = new DB('total');                                         // 專管 total 表
    $Bottom = new DB('bottom');                                       // 專管 bottom 表

    // $t = $Total->find(1);
    // $t['total']++;
    // $Total->save($t);

    // echo "<pre>";
    // print_r($t);
    // echo "</pre>";


?>