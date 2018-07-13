<?php

namespace App\traits;

use App\Model\Paginate;

trait Read
{
    private $binds;

    private $isPaginate = false;

    private $paginate;

    public function select($fields = '*')
    {
        $this->sql = "select {$fields} from {$this->table}";

        return $this;
    }

    public function where()
    {

        $num_args = func_num_args();

        $args = func_get_args();

        $args = $this->whereArgs($num_args, $args);

        $this->sql .= " where {$args['field']} {$args['sinal']} :{$args['field']}";

        $this->binds = [
            $args['field'] => $args['value'],
        ];

        return $this;

    }

    private function whereArgs($num_args, $args)
    {

        if ($num_args < 2) {
            throw new \Exception("Opa, algo de errado aconteceu, o where precisa de no mínimo 2 argumentos");
        }

        if ($num_args == 2) {
            $field = $args[0];
            $sinal = '=';
            $value = $args[1];
        }

        if ($num_args == 3) {
            $field = $args[0];
            $sinal = $args[1];
            $value = $args[2];
        }

        if ($num_args > 3) {
            throw new \Exception("Opa, algo de errado aconteceu, o where não pode ter mais que 3 argumentos");
        }

        return [
            'field' => $field,
            'sinal' => $sinal,
            'value' => $value,
        ];
    }

    public function get()
    {
        $select = $this->bindAndExecute();

        return $select->fetchAll();
    }

    public function first()
    {
        $select = $this->bindAndExecute();

        return $select->fetch();
    }

    private function bindAndExecute()
    {
        if ($this->isPaginate) {
            $this->sql = $this->sql . $this->paginate->sqlPaginate();
        }

        $select = $this->connect->prepare($this->sql);
        $select->execute($this->binds);

        return $select;
    }

    public function paginate($perPage)
    {
        $this->paginate = new Paginate;

        $this->paginate->records(count($this->get()));

        $this->paginate->paginate($perPage);

        $this->isPaginate = true;

        return $this;
    }

    public function links()
    {
        return $this->paginate->links();
    }

    public function orderBY($fields, $value){
        $fields = explode(',', $fields);
        $this->sql .= ' ORDER BY ';
        foreach ($fields as $field) {
            $this->sql .= "{$field}";
        }
        $this->sql .= " {$value} ";
        return $this;
    }

    public function busca($fields)
    {
        $fields = explode(',', $fields);
        $this->sql .= ' where ';
        foreach ($fields as $field) {
            $this->sql .= " {$field} like :{$field} or";
            $this->binds[$field] = '%'.busca().'%';
        }
        $this->sql = rtrim($this->sql, 'or');
        return $this;
    }

    public function findBy($field, $value){
        $this->sql = "select * from {$this->table}";

        $this->where($field, $value);

        return $this->first();
    }

}
