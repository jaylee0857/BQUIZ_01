# 🧩 PHP DB 類別操作教學筆記

本筆記整理自一個以 **PDO** 為核心的 `DB` 類別，  
用來操作 MySQL 資料庫，支援彈性參數與動態 SQL 組合。  
透過以下範例，你可以清楚理解每個方法輸入與 SQL 結果。

---

## 🧱 類別主要方法

#### 📘 使用範例

🧩 1️⃣ all(...$arg)
用途： 查詢多筆資料，可帶條件陣列或字串。
```php
function all(...$arg){
    $sql="select * from $this->table ";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
// 根據當前頁數去撈出對應範圍的資料
// "limit $start,$div" → SQL 範例：SELECT * FROM news LIMIT 3,3
// 表示從第 4 筆開始，取 3 筆資料（也就是第 4～6 筆）
$rows = ${ucfirst($do)}->all(" limit $start,$div");
```
```php
$DB->all();                              // 全部資料
$DB->all(['sh' => 1]);                   // 條件陣列
$DB->all(['main_id'=>0, 'sh'=>1]);       // 多條件陣列
$DB->all(" where sh=1 order by id desc"); // 自訂字串條件
$DB->all(['main_id'=>0], " order by id desc limit 0,5"); // 條件+附加SQL
```
🧮 結果 SQL：
| 調用方式                                                      | 組成的 SQL                                                            |
| --------------------------------------------------------- | ------------------------------------------------------------------ |
| `$DB->all()`                                              | `SELECT * FROM table`                                              |
| `$DB->all(['sh'=>1])`                                     | `SELECT * FROM table WHERE sh='1'`                                 |
| `$DB->all(['main_id'=>0,'sh'=>1])`                        | `SELECT * FROM table WHERE main_id='0' AND sh='1'`                 |
| `$DB->all(" where sh=1 order by id desc")`                | `SELECT * FROM table where sh=1 order by id desc`                  |
| `$DB->all(['main_id'=>0], " order by id desc limit 0,5")` | `SELECT * FROM table WHERE main_id='0' order by id desc limit 0,5` |

----------------------------------------------------------------------------------------------------------------------------------------------
🧩 2️⃣ count(...$arg)
用途： 計算資料筆數（可帶條件）。
```php
function count(...$arg){
    $sql="select count(*) from $this->table ";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
}
```

```php
$DB->count();                         // 全部筆數
$DB->count(['sh' => 1]);              // 條件計數
$DB->count(" where sh=1");            // 字串條件
$DB->count(['main_id'=>0]," limit 5"); // 條件 + 附加
```
🧮 結果 SQL：
| 調用方式                                    | 組成的 SQL                                                |
| --------------------------------------- | ------------------------------------------------------ |
| `$DB->count()`                          | `SELECT count(*) FROM table`                           |
| `$DB->count(['sh'=>1])`                 | `SELECT count(*) FROM table WHERE sh='1'`              |
| `$DB->count(" where sh=1")`             | `SELECT count(*) FROM table where sh=1`                |
| `$DB->count(['main_id'=>0]," limit 5")` | `SELECT count(*) FROM table WHERE main_id='0' limit 5` |

----------------------------------------------------------------------------------------------------------------------------------------------

🧩 3️⃣ find($id)
用途： 查詢單筆資料（可用 id 或條件陣列）。
```php
function find($id){
    $sql="select * from $this->table ";
    
    if(is_array($id)){
        $tmp=$this->arraytosql($id);
        $sql=$sql." where ".join(" AND " , $tmp);

    }else{
        $sql .= " WHERE `id`='$id'";
    }
    //echo $sql;
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
```
```php
$DB->find(7);                         // 以 id 查找
$DB->find(['acc'=>'admin']);          // 以條件查找
$DB->find(['acc'=>'admin','pw'=>'123']); // 多條件查找
```
🧮 結果 SQL：
| 調用方式                                      | 組成的 SQL                                              |
| ----------------------------------------- | ---------------------------------------------------- |
| `$DB->find(7)`                            | `SELECT * FROM table WHERE id='7'`                   |
| `$DB->find(['acc'=>'admin'])`             | `SELECT * FROM table WHERE acc='admin'`              |
| `$DB->find(['acc'=>'admin','pw'=>'123'])` | `SELECT * FROM table WHERE acc='admin' AND pw='123'` |

----------------------------------------------------------------------------------------------------------------------------------------------

🧩 4️⃣ save($array)
用途： 若有 id → UPDATE；否則 → INSERT。
```php
function save($array){
    if(isset($array['id'])){
        //update
        $sql="update $this->table set ";
        $tmp=$this->arraytosql($array);
        $sql.= join(" , ",$tmp) . "where `id`= '{$array['id']}'";
    }else{
        //insert
        $cols=join("`,`",array_keys($array));
        $values=join("','",$array);
        $sql="insert into $this->table (`$cols`) values('$values')";
    }

    return $this->pdo->exec($sql);
}

```
```php
$DB->save(['acc'=>'admin','pw'=>'123','name'=>'小明']); // 新增
$DB->save(['id'=>7,'pw'=>'456','name'=>'小華']);        // 更新
```
🧮 結果 SQL：
| 調用方式                                                   | 組成的 SQL                                                                |
| ------------------------------------------------------ | ---------------------------------------------------------------------- |
| `$DB->save(['acc'=>'admin','pw'=>'123','name'=>'小明'])` | `INSERT INTO table (`acc`,`pw`,`name`) VALUES ('admin','123','小明')`   |
| `$DB->save(['id'=>7,'pw'=>'456','name'=>'小華'])`        | `UPDATE table SET `id`='7' , `pw`='456' , `name`='小華' WHERE `id`='7'` |


----------------------------------------------------------------------------------------------------------------------------------------------

🧩 5️⃣ del($id)
用途： 刪除資料，可用 id 或條件陣列。
```php
function del($id){
    $sql="delete  from $this->table ";
    
    if(is_array($id)){
        $tmp=$this->arraytosql($id);
        $sql=$sql." where ".join(" AND " , $tmp);

    }else{
        $sql .= " WHERE `id`='$id'";
    }
    //echo $sql;
    return $this->pdo->exec($sql);
}
```
```php
$DB->del(7);                         // 以 id 刪除
$DB->del(['acc'=>'admin']);          // 以條件刪除
$DB->del(['acc'=>'admin','pw'=>'123']); // 多條件刪除
```
🧮 結果 SQL：
| 調用方式                                     | 組成的 SQL                                            |
| ---------------------------------------- | -------------------------------------------------- |
| `$DB->del(7)`                            | `DELETE FROM table WHERE id='7'`                   |
| `$DB->del(['acc'=>'admin'])`             | `DELETE FROM table WHERE acc='admin'`              |
| `$DB->del(['acc'=>'admin','pw'=>'123'])` | `DELETE FROM table WHERE acc='admin' AND pw='123'` |

----------------------------------------------------------------------------------------------------------------------------------------------

🧩 6️⃣ sum($col, ...$arg) //只有第二第三題用到
用途： 回傳指定欄位的加總（SUM()）。可帶條件陣列或字串，第二參數可附加自訂 SQL 片段（如 ORDER BY、LIMIT…）。
```php
function sum($col,...$arg){
    $sql="select sum($col) from $this->table ";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
}
```
```php
$Order->sum('`total`');                                        // 全部加總
$Order->sum('`amount`', ['user_id' => 5]);                     // 條件陣列
$Order->sum('`price`', ['status' => 1, 'paid' => 1]);          // 多條件陣列
$Order->sum('`subtotal`', " where date between '2025-10-01' and '2025-10-31'"); // 自訂字串條件
$Order->sum('`amount`', ['user_id' => 5], " order by id desc limit 10");        // 條件 + 附加 SQL
```

| 調用方式                                                                             | 組成的 SQL                                                                              |
| -------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| `$Order->sum('`total`')`                                                         | `SELECT sum(`total`) FROM table`                                                     |
| `$Order->sum('`amount`', ['user_id'=>5])`                                        | `SELECT sum(`amount`) FROM table WHERE user_id='5'`                                  |
| `$Order->sum('`price`', ['status'=>1,'paid'=>1])`                                | `SELECT sum(`price`) FROM table WHERE status='1' AND paid='1'`                       |
| `$Order->sum('`subtotal`', " where date between '2025-10-01' and '2025-10-31'")` | `SELECT sum(`subtotal`) FROM table where date between '2025-10-01' and '2025-10-31'` |
| `$Order->sum('`amount`', ['user_id'=>5], " order by id desc limit 10")`          | `SELECT sum(`amount`) FROM table WHERE user_id='5' order by id desc limit 10`        |

----------------------------------------------------------------------------------------------------------------------------------------------

🧩 7️⃣ max($col, ...$arg) // 只有第三題用到
用途： 回傳指定欄位的最大值（MAX()）。可帶條件陣列或字串，第二參數可附加自訂 SQL 片段。
```php
function max($col,...$arg){
    $sql="select max($col) from $this->table ";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
}
```
```php
$Grade->max('`score`');                                     // 全部最大值
$Grade->max('`score`', ['class_id' => 3]);                  // 條件陣列
$Grade->max('`score`', ['class_id' => 3, 'subject' => 'EN']); // 多條件
$Grade->max('`score`', " where exam_date >= '2025-11-01'"); // 自訂字串條件
$Grade->max('`score`', ['class_id' => 3], " order by id desc limit 1"); // 條件 + 附加 SQL
```
| 調用方式                                                                   | 組成的 SQL                                                                      |
| ---------------------------------------------------------------------- | ---------------------------------------------------------------------------- |
| `$Grade->max('`score`')`                                               | `SELECT max(`score`) FROM table`                                             |
| `$Grade->max('`score`', ['class_id'=>3])`                              | `SELECT max(`score`) FROM table WHERE class_id='3'`                          |
| `$Grade->max('`score`', ['class_id'=>3,'subject'=>'EN'])`              | `SELECT max(`score`) FROM table WHERE class_id='3' AND subject='EN'`         |
| `$Grade->max('`score`', " where exam_date >= '2025-11-01'")`           | `SELECT max(`score`) FROM table where exam_date >= '2025-11-01'`             |
| `$Grade->max('`score`', ['class_id'=>3], " order by id desc limit 1")` | `SELECT max(`score`) FROM table WHERE class_id='3' order by id desc limit 1` |


----------------------------------------------------------------------------------------------------------------------------------------------

⚙️ arraytosql() 工具方法
```php
private function arraytosql($array){
    $tmp=[];
    foreach($array as $key => $value){
        $tmp[]="`$key`='$value'";
    }

    return $tmp;
}
```
```php
['acc'=>'admin', 'pw'=>'123']

```
```php
["`acc`='admin'", "`pw`='123'"]
```
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
🎯 總結：整體結構的思路

| 方法        | 功能      | SQL 樣式                                                          |
| --------- | ------- | --------------------------------------------------------------- |
| `all()`   | 查詢多筆資料  | `SELECT * FROM table [WHERE ...] [ORDER BY ...] [LIMIT ...]`    |
| `count()` | 計算筆數    | `SELECT count(*) FROM table [WHERE ...]`                        |
| `find()`  | 查詢單筆    | `SELECT * FROM table WHERE id='...' 或 多條件`                      |
| `save()`  | 新增 / 更新 | `INSERT INTO table ...` 或 `UPDATE table SET ... WHERE id='...'` |
| `del()`   | 刪除資料    | `DELETE FROM table WHERE ...`                                   |
| `sum()` | 計算欄位總和 | `SELECT sum(column) FROM table [WHERE ...]` |
| `max()` | 取得欄位最大值 | `SELECT max(column) FROM table [WHERE ...]` |

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
```sql
SELECT [DISTINCT]
       欄位1 [AS 別名],
       欄位2 [AS 別名],
       函數(),
       表達式
FROM 資料表
[WHERE 條件]
[GROUP BY 欄位]
[HAVING 條件]
[ORDER BY 欄位 [ASC|DESC]]
[LIMIT 數量];
```
```sql
| 執行順序 | 關鍵字            | 說明                                |
| ---- | -------------- | --------------------------------- |
| 1️⃣  | FROM           | 決定要從哪張表取資料，並處理 JOIN（組合多表）         |
| 2️⃣  | ON             | 如果有 JOIN，這時才判斷 ON 條件（篩出符合連接條件的資料） |
| 3️⃣  | WHERE          | 篩掉不符合條件的資料（此時尚未分組）                |
| 4️⃣  | GROUP BY       | 將剩下的資料依指定欄位分組                     |
| 5️⃣  | HAVING         | 篩選「分組後」的群組結果（可以用聚合函式）             |
| 6️⃣  | SELECT         | 決定要輸出的欄位、計算表達式、別名等                |
| 7️⃣  | DISTINCT       | 去除重複的輸出列（如果有使用 DISTINCT）          |
| 8️⃣  | ORDER BY       | 根據指定欄位排序                          |
| 9️⃣  | LIMIT / OFFSET | 限制輸出筆數（例如 LIMIT 10）               |

```
```sql
INSERT INTO 資料表 (欄位1, 欄位2)
VALUES (值1, 值2),
       (值3, 值4),
       (值5, 值6);
```
```sql
UPDATE 資料表名稱
SET 欄位1 = 新值1,
    欄位2 = 新值2,
    ...
[WHERE 條件]
[ORDER BY 欄位 [ASC|DESC]]
[LIMIT 數量];
```
```sql
DELETE FROM 資料表名稱
[WHERE 條件]
[ORDER BY 欄位 [ASC|DESC]]
[LIMIT 數量];
```

| 項目     | `$pdo->exec()`                       | `$pdo->query()` | 
| ------ | ------------------------------------ | --------------- | 
| 用途     | 寫入 / 更新 / 刪除                         | 查詢（`SELECT`）    | 
| 是否回傳資料 | 否                                    | 是（結果集）          | 
| 回傳值    | 影響筆數（`int`）                          | `PDOStatement`  |         |
| 常見語法   | `INSERT` / `UPDATE` / `DELETE` / DDL | `SELECT ...`    | 
| 何時使用   | 不需要結果集                               | 需要讀取資料          | 

```php
// $_FILES = [
//   'img' => [
//     'name'     => 'campus_5_new.jpg',               // 原始檔案名稱
//     'type'     => 'image/jpeg',                     // MIME 類型
//     'tmp_name' => '/tmp/php3zU8sd',                 // PHP 暫存檔路徑
//     'error'    => 0,                                // 0 代表上傳成功
//     'size'     => 482131                            // 檔案大小（bytes）
//   ]
// ];
```

技術點
1. db.php的構成 db.php
2. pagination的組成 news.php
```
第一題 9張表 - 12大
第二題 5張表 - 15大
第三題 3張表 - 7大
第四題 6張表 - 9大