<?php
class DB
{
    // 資料庫連線設定
    private $dsn = "mysql:host=localhost;dbname=db01_1;charset=utf8";
    private $pdo;
    private $table;

    // 建構式：指定操作的資料表
    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    // 工具：把關聯陣列轉成 SQL 片段，例如 ['name'=>'AAA'] → `name`='AAA'
    private function arrayToSql($array)
    {
        $temp = [];
        foreach ($array as $key => $val) {
            $temp[] = "`$key`='$val'";
        }
        return $temp;
    }

    // 取得全部資料，可帶條件與額外 SQL（ORDER BY, LIMIT ...）
    function all(...$arg)
    {
        $sql = "SELECT * FROM {$this->table} ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                // 陣列條件
                $temp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $temp);
            } else {
                // 字串條件：直接接在後面（例如 " WHERE `name`='AAA'"）
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            // 額外 SQL，例如 " ORDER BY `id` DESC"、" LIMIT 10"
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 計算筆數
    function count(...$arg)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $temp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $temp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    // 取得單筆資料：可以用 id 或陣列條件
    function find($id)
    {
        $sql = "SELECT * FROM {$this->table} ";

        if (is_array($id)) {
            // 多欄位條件
            $temp = $this->arrayToSql($id);
            $sql .= " WHERE " . join(" AND ", $temp);
        } else {
            // 用主鍵 id
            $sql .= " WHERE `id`='{$id}'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // 取得欄位最大值
    function max($col, ...$arg)
    {
        $sql = "SELECT MAX($col) FROM {$this->table} ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $temp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $temp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    // 取得欄位總和
    function sum($col, ...$arg)
    {
        $sql = "SELECT SUM($col) FROM {$this->table} ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $temp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $temp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    // 刪除資料：可以用 id 或陣列條件
    function del($id)
    {
        $sql = "DELETE FROM {$this->table} ";

        if (is_array($id)) {
            $temp = $this->arrayToSql($id);
            $sql .= " WHERE " . join(" AND ", $temp);
        } else {
            $sql .= " WHERE `id`='{$id}'";
        }

        return $this->pdo->exec($sql);
    }

    // 新增或更新資料
    function save($array)
    {
        // 有帶 id：做 UPDATE
        if (isset($array['id'])) {
            $id = $array['id'];
            // 不更新 id 欄位本身，只拿來當 WHERE 條件
            unset($array['id']);

            // 如果拿掉 id 之後什麼欄位都沒有，就不需要更新
            if (empty($array)) {
                return 0;
            }

            $sql = "UPDATE {$this->table} SET ";
            $temp = $this->arrayToSql($array);
            $sql .= join(" , ", $temp) . " WHERE `id`='{$id}'";

        } else {
            // 沒有 id：做 INSERT
            $cols = join("`,`", array_keys($array));
            $vals = join("','", $array);
            $sql = "INSERT INTO {$this->table} (`{$cols}`) VALUES ('{$vals}')";
        }

        return $this->pdo->exec($sql);
    }
}
