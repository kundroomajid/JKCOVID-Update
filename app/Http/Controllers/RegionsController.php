<?php

namespace App\Http\Controllers;

use \App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\StatsService;

class RegionsController extends Controller
{
    public function statsAll($region = Null)
    {
        $region = $region ?? 'jk';
        $data = Regions::select([
            'id', 'date', 'name', 'postive_total', 'recovered_total',
            'deaths_total', 'total_active', 'created_at as last_updated'
        ])
            ->where('name', '=', $region)
            ->orderByDesc('date')
            ->first();

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "data" => $data
        ], 200);
    }

    public function statsLatest($region = Null)
    {
        $region = $region ?? 'jk';
        $data = Regions::select([
            'date', 'name', 'postive_new', 'recovered_new',
            'deaths_new', 'created_at as last_updated'
        ])
            ->where('name', '=', $region)
            ->orderByDesc('date')
            ->first();

        if ($data != Null && $data['deaths_new'] == Null) {
            $deaths = StatsService::getDeathsForDate($data['date'], $region);
            $data['deaths_new'] = $deaths;
            StatsService::updateDataInColumn($data['id'], $deaths, 'deaths_new');
        }
        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsYesterday($region = Null)
    {
        $region = $region ?? 'jk';
        $yesterday = Carbon::now()->format('Y-m-d');
        $data =  StatsService::statsForDate($yesterday, $region = Null);
        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsForDate($date, $region = Null)
    {
        $region = $region ?? 'jk';
        $data = StatsService::statsForDate($date, $region);

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }




    public function statsCurrWeek($region = Null)
    {
        $region = $region ?? 'jk';
        $now = Carbon::now();
        $week_start_date = $now->startOfWeek()->format('Y-m-d');
        $week_end_date = $now->endOfWeek()->format('Y-m-d');

        $data_curr_week = Regions::where('name', '=', $region)->whereBetween('date', [$week_start_date, $week_end_date])->orderByDesc('date')->get();

        if (sizeof($data_curr_week) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data_week_end = $data_curr_week[0];
        $data_week_start = $data_curr_week[sizeof($data_curr_week) - 1];

        $postive_curr_week = $data_week_end['postive_total'] - $data_week_start['postive_total'];
        $recovered_curr_week = $data_week_end['recovered_total'] - $data_week_start['recovered_total'];
        $deaths_curr_week = $data_week_end['deaths_total'] - $data_week_start['deaths_total'];

        $data = ["week" => $week_start_date . ':' . $data_week_end['date'], "postive_total" => $postive_curr_week, "recovered_total" => $recovered_curr_week, "deaths_total" => $deaths_curr_week];

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsPrevWeek($region = NULL)
    {
        $region = $region ?? 'jk';
        $now = Carbon::now();
        $prev_week_start_date = $now->subDays($now->dayOfWeek)->subWeek()->format('Y-m-d');
        $prev_week_end_date = $now->subDays($now->dayOfWeek)->addWeek()->format('Y-m-d');

        $data_prev_week = Regions::where('name', '=', $region)->whereBetween('date', [$prev_week_start_date, $prev_week_end_date])->orderByDesc('date')->get();
        if (sizeof($data_prev_week) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data_week_end = $data_prev_week[0];
        $data_week_start = $data_prev_week[sizeof($data_prev_week) - 1];

        $postive_prev_week = $data_week_end['postive_total'] - $data_week_start['postive_total'];
        $recovered_prev_week = $data_week_end['recovered_total'] - $data_week_start['recovered_total'];
        $deaths_prev_week = $data_week_end['deaths_total'] - $data_week_start['deaths_total'];

        $data = ["week" => $prev_week_start_date . ':' . $prev_week_end_date, "postive_total" => $postive_prev_week, "recovered_total" => $recovered_prev_week, "deaths_total" => $deaths_prev_week];

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsCurrMonth($region = Null)
    {
        $region = $region ?? 'jk';
        $now = Carbon::now();
        $month_start_date = $now->startOfMonth()->format('Y-m-d');
        $curr_date = Carbon::now()->format('Y-m-d');

        $data_curr_month = Regions::where('name', '=', $region)->whereBetween('date', [$month_start_date, $curr_date])->orderByDesc('date')->get();
        if (sizeof($data_curr_month) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data_month_end = $data_curr_month[0];
        $data_month_start = $data_curr_month[sizeof($data_curr_month) - 1];

        $postive_curr_month = $data_month_end['postive_total'] - $data_month_start['postive_total'];
        $recovered_curr_month = $data_month_end['recovered_total'] - $data_month_start['recovered_total'];
        $deaths_curr_month = $data_month_end['deaths_total'] - $data_month_start['deaths_total'];

        $data = ["Month" => Carbon::now()->format('m-Y'), "postive_total" => $postive_curr_month, "recovered_total" => $recovered_curr_month, "deaths_total" => $deaths_curr_month];

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsPrevMonth($region = NUll)
    {
        $region = $region ?? 'jk';
        $start = new Carbon('first day of last month');
        $month =  new Carbon('first day of last month');
        $month = $month->format('m-Y');
        $start = $start->format('Y-m-d');
        $end = new Carbon('last day of last month');
        $end = $end->format('Y-m-d');

        $data_prev_month = Regions::where('name', '=', $region)->whereBetween('date', [$start, $end])->orderByDesc('date')->get();
        if (sizeof($data_prev_month) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data_month_end = $data_prev_month[0];
        $data_month_start = $data_prev_month[sizeof($data_prev_month) - 1];

        $postive_prev_month = $data_month_end['postive_total'] - $data_month_start['postive_total'];
        $recovered_prev_month = $data_month_end['recovered_total'] - $data_month_start['recovered_total'];
        $deaths_prev_month = $data_month_end['deaths_total'] - $data_month_start['deaths_total'];

        $data = ["Month" => $month, "postive_total" => $postive_prev_month, "recovered_total" => $recovered_prev_month, "deaths_total" => $deaths_prev_month];

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }

    public function statsForMonth($month, $region = NULL)
    {
        $region = $region ?? 'jk';
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->format('Y-m-d');
        $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth()->format('Y-m-d');

        $data = Regions::where('name', '=', $region)->whereBetween('date', [$start, $end])->orderByDesc('date')->get();
        if (sizeof($data) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data_month_end = $data[0];
        $data_month_start = $data[sizeof($data) - 1];

        $postive_prev_month = $data_month_end['postive_total'] - $data_month_start['postive_total'];
        $recovered_prev_month = $data_month_end['recovered_total'] - $data_month_start['recovered_total'];
        $deaths_prev_month = $data_month_end['deaths_total'] - $data_month_start['deaths_total'];

        $data = ["Month" => $month, "postive_total" => $postive_prev_month, "recovered_total" => $recovered_prev_month, "deaths_total" => $deaths_prev_month];

        if (!$data) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $data
        ], 200);
    }


    //functions for graphs
    public function statsDaily($region = NULL)
    {
        $ret = [];
        $region = $region ?? 'jk';
        $allowed = ['jk', 'kashmir_div', 'jammu_div'];
        if (in_array($region, $allowed)) {
            $region = $region;
        } else {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }

        $data = Regions::where('name', '=', $region)->orderBy('date', 'asc')->get();

        foreach ($data as $d) {
            $out = ["date" => $d['date'], "postive" => $d['postive_new'], "recovered" => $d['recovered_new'], "deaths" => $d['deaths_new']];
            array_push($ret, $out);
        }
        return response()->json([
            "status" => 'success',
            "data" => $ret
        ], 200);
    }

    public function statsWeekly($region = NULL)
    {
        $ret = [];
        $region = $region ?? 'jk';
        $allowed = ['jk', 'kashmir_div', 'jammu_div'];
        if (in_array($region, $allowed)) {
            $region = $region;
        } else {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }

        $data = Regions::select('*')->where('name', '=', $region)->orderBy('date', 'asc')->get()->groupBy(function ($item) {
            $date = Carbon::parse($item->date);
            $start_week = $date->copy()->startOfWeek();
            $end_week = $date->copy()->endOfWeek();
            $or =  $start_week->format('Y-m-d') . ':' . $end_week->format('Y-m-d');
            return $or;
        });
        $ret_data = [];

        foreach ($data as $week => $val) {
            $postive = $val->sum('postive_new');
            $recovered = $val->sum('recovered_new');
            $deaths = $val->sum('deaths_new');
            $arr = ["week" => $week, "postive" => $postive, "recovered" => $recovered, "deaths" => $deaths];
            array_push($ret_data, $arr);
        }

        if (sizeof($data) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $ret_data
        ], 200);
    }

    public function statsMonthly($region = NULL)
    {
        $ret = [];
        $region = $region ?? 'jk';
        $allowed = ['jk', 'kashmir_div', 'jammu_div'];
        if (in_array($region, $allowed)) {
            $region = $region;
        } else {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        $data = Regions::select('*')->where('name', '=', $region)->orderBy('date', 'asc')->get()->groupBy(function ($item) {
            $or = Carbon::parse($item->date)->format('F') . '-' . Carbon::parse($item->date)->format('Y');
            return $or;
        });
        $ret_data = [];
        foreach ($data as $month => $val) {
            $postive = $val->sum('postive_new');
            $recovered = $val->sum('recovered_new');
            $deaths = $val->sum('deaths_new');
            $arr = ["month" => $month, "postive" => $postive, "recovered" => $recovered, "deaths" => $deaths];
            array_push($ret_data, $arr);
        }
        if (sizeof($data) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }
        return response()->json([
            "status" => "success",
            "region" => $region,
            "data" => $ret_data
        ], 200);
    }

    public function updateMissingValues()
    {
        ini_set('max_execution_time', 300);
        $d = Regions::orderBy('date', 'desc')->get();
        foreach ($d as $data) {
            $deaths = 0;
            $recovered = 0;
            $postive = 0;
            if ($data != Null && $data['deaths_new'] == Null) {
                try {
                    $deaths = StatsService::getDeathsForDate($data['date'], $data['name']);
                    StatsService::updateDataInColumn($data['id'], $deaths, 'deaths_new');
                } catch (\Throwable $th) {
                    print("<br>");
                    print("Deaths :" . $deaths);
                    print('   error in deaths : ' . $data['id']);
                }
            }
            if ($data != Null && $data['recovered_new'] == Null) {
                try {
                    $recovered = StatsService::getRecoveredForDate($data['date'], $data['name']);
                    $data['recovered_new'] = $recovered;
                    StatsService::updateDataInColumn($data['id'], $recovered, 'recovered_new');
                } catch (\Throwable $th) {
                    print("<br>");
                    print('error in recovery : ' . $data['id']);
                }
            }
            if ($data != Null && $data['postive_new'] == Null) {
                try {
                    $postive = StatsService::getPostiveForDate($data['date'], $data['name']);
                    $data['postive_new'] = $postive;
                    StatsService::updateDataInColumn($data['id'], $postive, 'postive_new');
                } catch (\Throwable $th) {
                    print("<br>");
                    print('error in postive : ' . $data['id']);
                }
            }
        }
    }

    public function detailedStats($date = Null)
    {
        if ($date == Null) {
            $date = Regions::select('date')->orderBy('date', 'desc')->get()->first()['date'];
        }
        $data = Regions::where('date', '=', $date)->orderBy('date', 'asc')->get();
        if (sizeof($data) == 0) {
            return response()->json([
                "status" => 'failure',
                "message" => "Data Not Found"
            ], 400);
        }

        return response()->json([
            "status" => "success",
            "data" => $data
        ], 200);
    }
}
