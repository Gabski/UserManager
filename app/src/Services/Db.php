<?php

class Db
{

    private static $mysqli;

    public static function connect($host, $user, $pass, $nazwa)
    {
        self::$mysqli = new mysqli($host, $user, $pass, $nazwa);
        self::$mysqli->set_charset('utf8');
    }

    public static function query($query)
    {
        return self::$mysqli->query($query);
    }

    public static function close()
    {
        return self::$mysqli->close();
    }

    public static function flush($table, $array, $id = null)
    {
        if ($id != null || $id != 0) {
            return self::update($table, $array, $id);
        } else {
            return self::save($table, $array);
        }
    }

    public static function save($table, $array)
    {

        $values = array_values($array);
        $keys = array_keys($array);

        $ile = count($values);

        for ($i = 0; $i < $ile; $i++) {
            $values[$i] = htmlspecialchars($values[$i]);
        }

        $sql = 'INSERT INTO `' . $table . '` (`' . implode('`,`', $keys) . '`) VALUES (\'' . implode('\',\'', $values) . '\')';
        if (self::$mysqli->query($sql) === true) {
            return mysqli_insert_id(self::$mysqli);
        } else {
            var_dump(mysqli_error(self::$mysqli));
            return false;
        }
    }

    public static function update($table, $inserts, $id)
    {

        $set = "";
        $i = 0;
        foreach ($inserts as $key => $value) {
            $value = htmlspecialchars($value);
            $set .= $i > 0 ? ", " : "";
            $set .= ' ' . $key . ' = "' . $value . '"';
            $i++;
        }

        $sql = 'UPDATE `' . $table . '` SET ' . $set . ' where `id`="' . $id . '"';

        if (self::$mysqli->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($table, $id)
    {

        $sql = "DELETE FROM " . $table . " WHERE id= " . $id;

        if (self::$mysqli->query($sql) === true) {
            return true;
        } else {
            return false;
        }

    }

    public static function export($tables = false, $backup_name = false)
    {
        $queryTables = self::$mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        foreach ($target_tables as $table) {

            $result = self::$mysqli->query('SELECT * FROM ' . $table);
            $fields_amount = $result->field_count;
            $rows_num = self::$mysqli->affected_rows;
            $res = self::$mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $content = (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";

                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }$content .= "\n\n\n";
        }
        $name = "baza";
        $backup_name = $backup_name ? $backup_name : $name . "___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . rand(1, 11111111) . ".sql";

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
        echo $content;exit;
    }

    public static function import($filename)
    {
        Db::drop();
        $templine = '';
        $lines = file($filename);
        foreach ($lines as $line) {

            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                Db::query($templine) or print('Error performing query \'<strong>' . $templine . '\': <br /><br />');
                $templine = '';
            }
        }
    }

    public static function drop($tables = false)
    {
        $queryTables = self::$mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        foreach ($target_tables as $table) {
            self::$mysqli->query('DROP TABLE ' . $table);
        }
    }

    public static function truncate($tables = false)
    {
        $queryTables = self::$mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        foreach ($target_tables as $table) {
            self::$mysqli->query('TRUNCATE TABLE ' . $table);
        }
    }
}