<?php

namespace App\Services;

use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatsService
{
    public static function getDeathsForDate($date, $region_name)
    {
        $data_for_date =  Regions::select('id', 'name', 'date', 'deaths_new', 'deaths_total')->where('name', '=', $region_name)->where('date', '=', $date)->get()->first();
        $date_obj = Carbon::createFromFormat('Y-m-d', $date);
        $prev_date = $date_obj->subDays(1);
        $prev_date = $prev_date->format('Y-m-d');

        $data_for_prev_date = Regions::select('id', 'name', 'date', 'deaths_new', 'deaths_total')->where('name', '=', $region_name)->where('date', '=', $prev_date)->get()->first();
        // calculate deaths from data of prev_date and curr_date

        $deaths = $data_for_date['deaths_total'] - $data_for_prev_date['deaths_total'];

        return $deaths;
    }

    public static function getRecoveredForDate($date, $region_name)
    {
        $data_for_date =  Regions::select('id', 'name', 'date', 'recovered_new', 'recovered_total')->where('name', '=', $region_name)->where('date', '=', $date)->get()->first();
        $date_obj = Carbon::createFromFormat('Y-m-d', $date);
        $prev_date = $date_obj->subDays(1);
        $prev_date = $prev_date->format('Y-m-d');

        $data_for_prev_date = Regions::select('id', 'name', 'date', 'recovered_new', 'recovered_total')
            ->where('name', '=', $region_name)->where('date', '=', $prev_date)->get()->first();
        // calculate deaths from data of prev_date and curr_date


        $recovered = $data_for_date['recovered_total'] - $data_for_prev_date['recovered_total'];

        return $recovered;
    }
    public static function getPostiveForDate($date, $region_name)
    {
        $data_for_date =  Regions::select('id', 'name', 'date', 'postive_new', 'postive_total')->where('name', '=', $region_name)->where('date', '=', $date)->get()->first();
        $date_obj = Carbon::createFromFormat('Y-m-d', $date);
        $prev_date = $date_obj->subDays(1);
        $prev_date = $prev_date->format('Y-m-d');

        $data_for_prev_date = Regions::select('id', 'name', 'date', 'postive_new', 'postive_total')->where('name', '=', $region_name)->where('date', '=', $prev_date)->get()->first();
        // calculate deaths from data of prev_date and curr_date

        $postive = $data_for_date['postive_total'] - $data_for_prev_date['postive_total'];

        return $postive;
    }

    public static function updateDataInColumn($id, $value, $field)
    {
        $data = Regions::findOrFail($id);
        $data->$field = $value;
        $data->save();
        return True;
    }

    public static function statsForDate($date, $region = Null)
    {
        $region = $region ?? 'jk';
        $data = Regions::select([
            'id', 'date', 'name', 'postive_new', 'recovered_new',
            'deaths_new', 'created_at as last_updated'
        ])
            ->where('name', '=', $region)
            ->where('date', '=', $date)
            ->orderByDesc('date')
            ->first();
        if ($data != Null && $data['deaths_new'] == Null) {
            $deaths = self::getDeathsForDate($data['date'], 'jk');
            $data['deaths_new'] = $deaths;
            self::updateDataInColumn($data['id'], $deaths, 'deaths_new');
        }
        if ($data != Null && $data['recovered_new'] == Null) {
            $recovered = self::getRecoveredForDate($data['date'], 'jk');
            $data['recovered_new'] = $recovered;
            self::updateDataInColumn($data['id'], $recovered, 'recovered_new');
        }
        if ($data != Null && $data['postive_new'] == Null) {
            $postive = self::getPostiveForDate($data['date'], 'jk');
            $data['postive_new'] = $postive;
            self::updateDataInColumn($data['id'], $postive, 'postive_new');
        }
        if (!$data) {
            false;
        }
        return $data;
    }
}
