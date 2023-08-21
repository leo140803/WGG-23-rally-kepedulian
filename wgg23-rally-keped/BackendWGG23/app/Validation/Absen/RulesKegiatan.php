<?php

namespace App\Validation\Absen;

class RulesKegiatan
{
    public function valid_time($str): bool
    {
        return preg_match("/^([01][0-9]|2[0-4]):[0-5][0-9]$/", $str);
    }

    public function later_than(?string $str, string $field, array $data): bool
    {
        return array_key_exists($field, $data) && strtotime($str) > strtotime($data[$field]);
    }

    public function date_not_passed($str): bool
    {
        $date = strtotime(str_replace('/', '-', $str));
        $today = strtotime('today');
        return $date >= $today;
    }

    public function time_not_passed(?string $str, string $field, array $data): bool
    {
        if (!array_key_exists($field, $data)) {
            return false;
        }
        $today = strtotime('today');
        $date = strtotime(str_replace('/', '-', $data[$field]));
        if ($date > $today) {
            return true;
        }
        $time = strtotime($str);
        $now = strtotime('now');
        return $time >= $now;
    }
}
