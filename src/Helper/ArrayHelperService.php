<?php

namespace App\Helper;

class ArrayHelperService implements Helper
{
    /**
     * Filter data.
     *
     * @param string $key
     * @param string $sign
     * @param string $value
     * @param array $data
     *
     * @return array $data
     */
    public function select(string $key, string $sign, string $value, array $data): array
    {
        $value = strtolower($value);
        foreach ($data as $k => &$v) {
            switch ($sign) {
                case '=':
                    $expression = (strtolower($v[$key]) == $value);
                    break;
                case '!=':
                    $expression = (strtolower($v[$key]) != $value);
                    break;
                case '>':
                    $expression = (strtolower($v[$key]) > $value);
                    break;
                case '<':
                    $expression = (strtolower($v[$key]) < $value);
                    break;
                case '>=':
                    $expression = (strtolower($v[$key]) >= $value);
                    break;
                case '<=':
                    $expression = (strtolower($v[$key]) <= $value);
                    break;
            }
            if (!$expression) unset($data[$k]);
        }
        return $data;
    }

    /**
     * Sort data.
     *
     * @param string $key
     * @param array $data
     *
     * @return array $data
     */
    public function sort(string $key, string $order, array $data): array
    {
        usort($data, function($a, $b) use ($key, $order) {
            if ($order == 'DESC') return strtolower($b[$key]) <=> strtolower($a[$key]);
            return strtolower($a[$key]) <=> strtolower($b[$key]);
        });
        return $data;
    }

    /**
     * Select only provided fields.
     *
     * @param array $fields
     * @param array $data
     *
     * @return array $data
     */
    public function only(array $fields, array $data): array {
        return $this->filter( $data, $fields);
    }

    /**
     * Filter and remove not selected fields.
     *
     * @param array $data
     * @param array $fields
     *
     * @return array $data
     */
    private function filter(array &$data, array $fields): array {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this->filter($value, $fields); //recursive
            }else if(!in_array($key, $fields)) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}