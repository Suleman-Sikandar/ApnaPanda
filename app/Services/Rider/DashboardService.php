<?php
namespace App\Services\Rider;
use App\Models\TblRiderModel;
class DashboardService{
    public function index($id)
    {
        $rider=TblRiderModel::find($id);
        return view('rider.dashboard', compact('rider'));
    }
}