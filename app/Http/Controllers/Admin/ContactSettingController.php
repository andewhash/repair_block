<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contactSettings = ContactSetting::firstOrNew();
        return view('admin.contact_settings.edit', compact('contactSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'map_link' => 'nullable|url|max:500',
            'phone_primary' => 'nullable|string|max:20',
            'phone_secondary' => 'nullable|string|max:20',
            'email_primary' => 'nullable|email|max:255',
            'email_secondary' => 'nullable|email|max:255',
            'work_hours' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'additional_info' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $contactSettings = ContactSetting::firstOrNew();

        // Обработка загрузки логотипа
        if ($request->hasFile('logo')) {
            // Удаляем старый логотип
            if ($contactSettings->logo_path) {
                Storage::delete(str_replace('storage/', 'public/', $contactSettings->logo_path));
            }
            
            // Сохраняем новый
            $path = $request->file('logo')->store('public/logos');
            $validated['logo_path'] = str_replace('public/', 'storage/', $path);
        }

        // Преобразуем социальные сети из массива в JSON
        if ($request->has('social_links')) {
            $socialLinks = [];
            foreach ($request->social_links as $key => $value) {
                if (!empty($value)) {
                    $socialLinks[$key] = $value;
                }
            }
            $validated['social_links'] = json_encode($socialLinks);
        }

        $contactSettings->fill($validated);
        $contactSettings->save();

        return redirect()->route('admin.contact-settings.edit')
                         ->with('success', 'Настройки контактов успешно обновлены');
    }
}