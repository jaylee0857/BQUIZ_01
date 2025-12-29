<?php 
date_default_timezone_set("Asia/Taipei");
session_start();
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql){
    $dsn="mysql:host=localhost;dbname=db01;charset=utf8";
    $pdo=new PDO($dsn,"root",'');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

Class DB {
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db01;";
    private $pdo;
    private $table;
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    public function all(...$arg){
        $sql = "SELECT * FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $sql = "SELECT * FROM `$this->table` ";
        if(is_array($id)){
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " .join(" AND ", $tmp);
        }else {
            $sql .= " WHERE `id` = '$id'";
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($id){
        $sql = "DELETE FROM `$this->table` ";
        if(is_array($id)){
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " . join(" AND ", $tmp);
        }else {
            $sql .= " WHERE `id` = '$id'";
        }
        return $this->pdo->exec($sql);
    }

    public function count(...$arg) {
        $sql = "SELECT count(*) FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function max($col,...$arg) {
        $sql = "SELECT max(`$col`) FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " .join(" AND ", $tmp);
            }else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function sum($col,...$arg) {
        $sql = "SELECT sum(`$col`) FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " .join(" AND ", $tmp);
            }else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function save($array){ 
        if(isset($array['id'])){
            $id = $array['id'];
            unset($array['id']);
            $sql = "UPDATE `$this->table` SET ";
            $tmp = $this->array_to_sql($array);
            $sql .= join(",", $tmp) . " WHERE `id` = '$id'";
        }else{
            $cols = join("`,`", array_keys($array));
            $vals = join("','", $array);
            $sql = "INSERT INTO `$this->table` (`$cols`) VALUES('$vals')";
        }

        echo $sql;
        return $this->pdo->exec($sql);
    }

    private function array_to_sql($ary){
        $tmp = [];
        foreach($ary as $key => $val){
            $tmp[] = "`$key`='$val'";
        }
        return $tmp;
    }
}
$News = new DB('news');
$data = $News->all();
$find = $News->find(1);
$find1 = $News->find(['id'=>'2']);
dd($data);
$News->save(['text'=>'我出來了 22']);
$data = $News->all();
dd($data);

// $News->del(2);
// dd($find);
// dd($find1);
// var_dump($find);
// dd($News->count());
// dd($News->max("text"));
// dd($News->sum("sh"));

?>