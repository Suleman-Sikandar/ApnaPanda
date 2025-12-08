<?php
namespace App\Services\Admin;

use App\Models\TblPaymentMethode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodService
{
    public function index()
    {
        $paymentMethods = TblPaymentMethode::orderBy('display_order', 'asc')->get();
        return view('admin.payment_method.listing', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'payment_methode' => 'required|string|max:255',
            'display_order'   => 'nullable|string',
            'icon'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('payment_methods', 'public');
        }

        TblPaymentMethode::create($data);

        return response()->json(['status' => true, 'success' => 'Payment Method created successfully!']);
    }

    public function edit($id)
    {
        $paymentMethod = TblPaymentMethode::findOrFail($id);
        return response()->json(['status' => true, 'data' => $paymentMethod]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'payment_methode' => 'required|string|max:255',
            'display_order'   => 'nullable|string',
            'icon'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $paymentMethod = TblPaymentMethode::findOrFail($id);
        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            if ($paymentMethod->icon && Storage::disk('public')->exists($paymentMethod->icon)) {
                Storage::disk('public')->delete($paymentMethod->icon);
            }
            $data['icon'] = $request->file('icon')->store('payment_methods', 'public');
        }

        $paymentMethod->update($data);

        return response()->json(['status' => true, 'success' => 'Payment Method updated successfully!']);
    }

    public function destroy($id)
    {
        $paymentMethod = TblPaymentMethode::findOrFail($id);
        
        if ($paymentMethod->icon && Storage::disk('public')->exists($paymentMethod->icon)) {
            Storage::disk('public')->delete($paymentMethod->icon);
        }

        $paymentMethod->delete();

        return response()->json(['status' => true, 'success' => 'Payment Method deleted successfully!']);
    }
}
