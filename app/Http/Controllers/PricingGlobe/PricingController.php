<?php

namespace App\Http\Controllers\PricingGlobe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GlobalPricing;

class PricingController extends Controller
{
    // Fungsi harga global
    public function pricing_globe(Request $request)
    {
        $value = str_replace('.', '', $request->value);

        GlobalPricing::create([
            'nama_event' => $request->nama_event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'value' => $value,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->back()->with('success', 'Harga Musim Telah Aktif');
    }

    public function destroy_price($id)
    {
        $pricing = GlobalPricing::findOrFail($id);
        $pricing->delete();

        return redirect()->back()->with('success', 'Harga Kembali Normal');
    }
}
