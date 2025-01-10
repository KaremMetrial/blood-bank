<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Http\Request;

    class SettingController extends Controller
    {
        /**
         * Display the settings page.
         */
        public function settings()
        {
            $setting = Setting::first();

            return view('admins.settings.index', compact('setting'));
        }

        /**
         * Update the settings.
         */
        public function updateSettings(Request $request)
        {
            $request->validate([
                'notification_setting_text' => 'nullable|string',
                'about_app' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|email',
                'f_link' => 'nullable|url',
                't_link' => 'nullable|url',
                'ins_link' => 'nullable|url',
            ]);

            $setting = Setting::firstOrCreate([]);

            $setting->update([
                'notification_setting_text' => $request->input('notification_setting_text', ''),
                'about_app' => $request->input('about_app', ''),
                'phone' => $request->input('phone', ''),
                'email' => $request->input('email', ''),
                'f_link' => $request->input('f_link', ''),
                't_link' => $request->input('t_link', ''),
                'ins_link' => $request->input('ins_link', ''),
            ]);

            toastr()->success('Settings updated successfully');

            return redirect()->back();
        }
    }
