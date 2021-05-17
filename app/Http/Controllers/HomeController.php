<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Regions;
use Carbon\Carbon;
use DataTables;

class HomeController extends Controller
{
    public function getAllStats($region = null)
    {
        $region = $region ?? 'jk';
        $all_stats = Regions::select([
            'id', 'date', 'name', 'postive_total', 'recovered_total',
            'deaths_total', 'total_active', 'postive_new', 'recovered_new',
            'deaths_new', 'created_at as last_updated'
        ])
            ->where('name', '=', $region)
            ->orderByDesc('date')
            ->first();

        if ($all_stats) {
            $last_updated = $all_stats['last_updated'];
            $last_updated = Carbon::createFromTimeString($last_updated, $tz = 'Asia/Calcutta')->format('l jS \of F Y h:i:s A') ?? "NA";
            $all_stats['last_updated'] = $last_updated;
            return $all_stats;
        } else {
            return null;
        }
    }
    public function getHomePage()
    {
        // get required data for homepage
        $all_stats_jk = $this->getAllStats('jk');
        $all_stats_kashmir = $this->getAllStats('kashmir_div');
        $all_stats_jammu = $this->getAllStats('jammu_div');

        return view('home', compact('all_stats_jk', 'all_stats_kashmir', 'all_stats_jammu'));
    }

    public function getDataForAllRegions(Request $request)
    {

        if ($request->ajax()) {
            // $data = Regions::all();
            $data = Regions::select([
                'id', 'date', 'name', 'postive_total', 'recovered_total',
                'deaths_total', 'total_active', 'postive_new', 'recovered_new',
                'deaths_new', 'created_at'
            ])
                ->orderByDesc('date')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
