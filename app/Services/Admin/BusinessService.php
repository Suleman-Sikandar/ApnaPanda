<?php
namespace App\Services\Admin;
use App\Models\TblBusiness;
use Illuminate\Support\Facades\Validator;

class BusinessService
{
    public function index()
    {
        $businesses = TblBusiness::all();
        return view('admin.business.listing', compact('businesses'));
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'display_order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        TblBusiness::create($request->all());

        return response()->json(['status' => true, 'success' => 'Business added successfully.']);
    }

    public function edit($id)
    {
        $business = TblBusiness::find($id);
        if ($business) {
            return response()->json(['status' => true, 'data' => $business]);
        }
        return response()->json(['status' => false, 'error' => 'Business not found.']);
    }

    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'display_order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $business = TblBusiness::find($id);
        if ($business) {
            $business->update($request->all());
            return response()->json(['status' => true, 'success' => 'Business updated successfully.']);
        }

        return response()->json(['status' => false, 'error' => 'Business not found.']);
    }

    public function destroy($id)
    {
        $business = TblBusiness::find($id);
        if ($business) {
            $business->delete();
            return response()->json(['status' => true, 'success' => 'Business deleted successfully.']);
        }
        return response()->json(['status' => false, 'error' => 'Business not found.']);
    }
}