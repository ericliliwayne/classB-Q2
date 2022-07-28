<?php
    session_start();
    date_default_timezone_set("asia/Taipei");

    class DB{
        protected $table;
        protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db20";
        protected $pdo;

        function __construct($table)
        {
            $this->table = $table;
            $this->pdo = new PDO($this->dsn,'root','');
        }

        /**
         * 1.新增資料 insert() insert into $table...
         * 2.修改資料 update() update $table set...
         *  -> save()
         * 3.查詢資料 all(),find() select from $table
         * 4.刪除資料 del() delete from $table
         * 5.計算 max(),min(),sum(),count(),avg() -> math() select max() from table
         
        *($array)//特定欄位條件的多筆資料
        *($array,$sql)//有欄位條件又有額外條件的多筆資料...where ...limit ..., ..where ... order by...
        *() //整張資料表的內容
        *($sql) //只有額外條件的多筆資料 ...limit $start,$div... ,order by ... ,group by...
        * ($array,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
    * ($sql,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
        */
        function all(...$arg){
            $sql = "SELECT * FROM $this->table ";
            if(isset($arg[0])){
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key` = '$value'";
                    }
                    $sql .= " where ".join(" && ",$tmp);
                }else{
                    $sql .= $arg[0];
                }
            }
            if(isset($arg[1])){
                $sql .= $arg[1];
            }
            // echo $sql;
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        function find($arg){
            $sql = "SELECT * FROM $this->table WHERE ";
            
                if(is_array($arg)){
                    foreach($arg as $key => $value){
                        $tmp[]="`$key` = '$value'";
                    }
                    $sql .= join(" && ",$tmp);
                }else{
                    $sql .= " `id`='$arg'";
                }
            
            // echo $sql;
            return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
        function save($array){
            if(isset($array['id'])){
                //更新
                foreach($array as $key => $value){
                    $tmp[]="`$key` = '$value'";
                }
                $sql = "UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='{$array['id']}'";
            }else{
                //新增
                $sql = "INSERT INTO $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
            }
            return $this->pdo->exec($sql);
        }
        function del($arg){
            $sql = "DELETE FROM $this->table WHERE ";
            
                if(is_array($arg)){
                    foreach($arg as $key => $value){
                        $tmp[]="`$key` = '$value'";
                    }
                    $sql .= join(" && ",$tmp);
                }else{
                    $sql .= " `id`='$arg'";
                }
            
            // echo $sql;
            return $this->pdo->exec($sql);
        }
        function math($math,$col,...$arg){
            $sql = "SELECT $math($col) FROM $this->table ";
            if(isset($arg[0])){
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key` = '$value'";
                    }
                    $sql .= " where ".join(" && ",$tmp);
                }else{
                    $sql .= $arg[0];
                }
            }
            if(isset($arg[1])){
                $sql .= $arg[1];
            }
            // echo $sql;
            return $this->pdo->query($sql)->fetchColumn();
        }
        function q($sql){ //萬用型
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

    }

    function dd($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function to($url){
        header("location:".$url);
    }
    // new DB($table);
    $Total = new DB('total');//$Total是物件
    $User = new DB('user');
    
    if(!isset($_SESSION['total'])){
        $chkDate = $Total->math('count','id',['date'=>date("Y-m-d")]);
        if($chkDate >= 1){
        $today = $Total->find(['date'=>date("Y-m-d")]);
        $total['total']++;
        $Total->save($total); 
        $_SESSION['total'] = 1;
        }else{
            $Total->save(['date'=>date("Y-m-d"),'total'=>1]);
            $_SESSION['total']=1;
        }
        
    }

?>