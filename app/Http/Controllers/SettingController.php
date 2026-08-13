<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'currency' => 'required|string|max:10',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);
        $setting->update($validated);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}