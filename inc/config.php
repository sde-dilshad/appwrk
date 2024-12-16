<?php
class DB
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "appwrk");
    }


    public function select($tbl_name, $where = [])
    {
        $tbl_name = $this->conn->real_escape_string($tbl_name);

        $sql = "SELECT * FROM {$tbl_name} ";

        if (!empty($where)) {
            $params = [];
            foreach ($where as $key => $value) {
                $value = $this->conn->real_escape_string($value);
                $key = $this->conn->real_escape_string($key);
                $params[] = " $key = $value ";
            }

            $sql .= " WHERE " . implode(" AND ", $params);
        }

        return $this->conn->query($sql);
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }


    public function filter($str)
    {
        $str = htmlspecialchars($str);
        $str = html_entity_decode($str);
        $str = str_replace("'", "\'", $str);
        return $str;
    }
}

$db = new DB();
