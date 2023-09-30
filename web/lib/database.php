<?php

class sql
{
    public $user;
    public $pass;
    public $dbname;
    public $db;
    public $field;
    public function config($u,$p,$dn,$db)
    {
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $dn;
        $this->db = $db;
    }
    public function put_data($data)
    {
        $this->field=$data;
    }
    public function conn()
    {
        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=$this->dbname;charset=utf8",$this->user,$this->pass);
        }
        catch (PDOException $e)
        {
            throw new PDOException($e->getMessage());
        }
        return $pdo;
    }
    public function add($val)
    {
        $pdo = $this->conn();
        $sql = "INSERT INTO `". $this->db ."` VALUES".$val;
        $sth = $pdo->prepare($sql);
        try
        {
            if (!($sth->execute($this->field)))
            {
                die();
            }

        }
        catch (PDOException $e)
        {
            die();
        }
        unset($pdo);
    }
    public function led_sel()
    {
        $pdo = $this->conn();
        $sql = "SELECT * FROM `". $this->db ."` ORDER BY time DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comments = array();
        try
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($comments, array(
                    "id" => $row[$this->field[0]],
                    "state" => $row[$this->field[1]],
                    "time" => $row[$this->field[2]]
                ));
            }
        }
        catch (PDOException $e)
        {
            die();
        }
        unset($pdo);
        return $comments;
    }
    public function dht_sel()
    {
        $pdo = $this->conn();
        $sql = "SELECT * FROM `". $this->db ."` ORDER BY time DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comments = array();
        try
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($comments, array(
                    "id" => $row[$this->field[0]],
                    "state" => $row[$this->field[1]],
                    "temperature" => $row[$this->field[2]],
                    "humidity" => $row[$this->field[3]],
                    "time" => $row[$this->field[4]]
                ));
            }
        }
        catch (PDOException $e)
        {
            die();
        }
        unset($pdo);
        return $comments;
    }
    public function flame_sel()
    {
        $pdo = $this->conn();
        $sql = "SELECT * FROM `". $this->db ."` ORDER BY time DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comments = array();
        try
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($comments, array(
                    "id" => $row[$this->field[0]],
                    "state" => $row[$this->field[1]],
                    "heat" => $row[$this->field[2]],
                    "time" => $row[$this->field[3]]
                ));
            }
        }
        catch (PDOException $e)
        {
            die();
        }
        unset($pdo);
        return $comments;
    }
    public function control_sel()
        {
            $pdo = $this->conn();
            $sql = "SELECT * FROM `". $this->db ."` ORDER BY time DESC LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $comments = array();
            try
            {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    array_push($comments, array(
                        "id" => $row[$this->field[0]],
                        "dht11" => $row[$this->field[1]],
                        "flame" => $row[$this->field[2]],
                        "led" => $row[$this->field[3]],
                        "time" => $row[$this->field[4]]
                    ));
                }
            }
            catch (PDOException $e)
            {
                die();
            }
            unset($pdo);
            return $comments;
        }
}
?>