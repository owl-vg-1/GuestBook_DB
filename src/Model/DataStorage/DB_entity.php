<?php
namespace App\Model\DataStorage;

class DB_entity
{
    public $link;
    public $name_db;
    public $page_size = 4;
    public $default_select = [
        'SELECT' => '*',
        'FROM' => null,
        'WHERE' => 1,
        'GROUP BY' => null,
        'HAVING' => null,
        'ORDER BY' => null,
        'LIMIT' => null
    ];
    public $current_select = [];
    public $error_list = [];


    public function __construct($link, $tabl_name)
    {
        $this->link = $link;
        $this->tabl_name = $tabl_name;
        $this->current_select = ['FROM' => $this->tabl_name];
    }

    public function get_sql()
    {
        $buf_arr = array_merge($this->default_select, $this->current_select);
        $sql = "";
        foreach ($buf_arr as $k => $v) {
            if (isset($v)) {
                $sql .= $k . " " . $v . "\n";
            }
        }
        return $sql;
    }

    public function query()
    {

        $query_result = $this->execute_sql($this->get_sql());
        if ($query_result !== false) {
            return $this->result_query_table($query_result);
        } else {
            return false;
        }


    }

    public function execute_sql($sql)
    {
        $query_result = $this->link->query($sql);
        $this->error_list[] = $this->link->error;
        return $query_result;
    }

    public function result_query_table($query_result)
    {
        $result = [];
        while ($row = $query_result->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }

    function reset_default_select()
    {
        $this->current_select = [];
        $this->current_select['FROM'] = $this->table_name;
        return $this;
    }


    public function add_where_condition($add_query)
    {
        if (!empty($this->current_select['WHERE'])) {
            $this->current_select['WHERE'] .= "AND $add_query";
        } else {
            $this->current_select['WHERE'] = $add_query;
        }
        return $this;
    }

    public function reset_where_condition()
    {
        unset($this->current_select['WHERE']);
        return $this;
    }

    public function add_order_ask($add_order)
    {
        if (!empty($this->current_select['ORDER BY'])) {
            $this->current_select['ORDER BY'] .= ", $add_order ASC";
        } else {
            $this->current_select['ORDER BY'] = " $add_order ASC";
        }
    }

    public function add_order_desk($add_order)
    {
        if (!empty($this->current_select['ORDER BY'])) {
            $this->current_select['ORDER BY'] .= ", $add_order DESC";
        } else {
            $this->current_select['ORDER BY'] = " $add_order DESC";
        }
    }

    public function reset_order()
    {
        unset($this->current_select['ORDER BY']);

    }


    public function reset_select()
    {
        unset($this->current_select['SELECT']);
        return $this;
    }

    public function select_asterisk()
    {
        $this->current_select['SELECT'] = "*";
    }

    public function set_select($select)
    {
        if ($this->current_select['SELECT'] == "*") {
            $this->reset_select();
            $this->current_select['SELECT'] = $select;
        } elseif (!empty($this->current_select['SELECT'])) {
            $this->current_select['SELECT'] = ", $select";
        } elseif (empty($this->current_select['SELECT'])) {
            $this->current_select['SELECT'] = $select;
        }
        return $this;
    }

    function set_page($page)
    {
        $this->current_select['LIMIT'] = $page * $this->page_size . ", $this->page_size";
        return $this;
    }

    function set_page_size($size)
    {
        $this->page_size = $size;
        return $this;
    }

    // посчитать количество страниц

    function page_count()
    {
        return ceil($this->count_rows() / $this->page_size);
    }


    function reset_page()
    {
        unset($this->current_select['LIMIT']);
    }


    function add_group_by($str)
    {
        $this->current_select['GROUP BY'] = !empty($this->current_select['GROUP BY']) ? $this->current_select['GROUP BY'] . ", $str" : $str;
    }

    function reset_group_by()
    {
        unset($this->current_select['GROUP BY']);
    }


    function add_having_condition($str)
    {
        $this->current_select['HAVING'] = !empty($this->current_select['HAVING']) ? $this->current_select['HAVING'] . " AND $str" : $str;
    }

    function reset_having_condition()
    {
        unset($this->current_select['HAVING']);
    }
    // получить массив с именами полей из таблицы базы данных
    function get_filds()
    {
        return array_column($this->result_query_table($this->execute_sql('SHOW COLUMNS FROM ' . $this->tabl_name)), 'Field');
    }

    // Получить массив с именами поля комментариев в таблице
    function get_comments()
    {
        $array = $this->result_query_table($this->execute_sql("SELECT COLUMN_COMMENT, COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = '$this->tabl_name'"));
        $array_reult = [];
        foreach ($array as $value) {
            $array_reult[$value['COLUMN_NAME']] = $value['COLUMN_COMMENT'];
        }
        return $array_reult;
    }



    // удалить строку из таблицы
    function delete_line($num)
    {
        $this->execute_sql('DELETE FROM ' . $this->tabl_name . ' WHERE id = ' . $num);
        return $this->link->affected_rows;
    }

    // добавить строку в таблицу
    function add_line($array)
    {
        $filds =[];
        $val = [];
        foreach ($array as $key => $value) {
            $filds[] = $key;
            $val[] = "'" .$value. "'";
        }
        $this->execute_sql('INSERT INTO ' . $this->tabl_name . '( ' . implode(",", $filds ). ') VALUES (' .implode(", ", $val ). ')');
        return $this->link->insert_id;
    }
    // Количество строк в таблице БД
    function count_rows()
    {
        return $this->result_query_table($this->execute_sql('SELECT COUNT(*) AS C FROM ' . $this->tabl_name))[0]['C'];
    }

    // Удалить таблицу 
    function dell_table()
    {
        $this->execute_sql("DROP table $this->tabl_name");
        return $this->link->affected_rows;
    }

    // О чистить таблицу 
    function clear_table()
    {
        $this->execute_sql("DELETE FROM $this->tabl_name");
        return $this->link->affected_rows;
    }

    // Редактировать запись
    function edit_line($id, $array)
    {
        foreach ($array as $key => $value) {
            $new_array[] = "$key='$value'";
        }

        $this->execute_sql("UPDATE $this->tabl_name SET " . implode(',', $new_array) . " WHERE id = $id");
        return $this->link->affected_rows;
    }

    // Получить строку из таблицы базы данных по id
    function get_row_by_id($id)
    {
        $arr = $this->add_where_condition("id = $id")->query()[0];
        unset($arr['id']);
        return $arr;
    }
}
