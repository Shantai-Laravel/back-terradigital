<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Service;


class ReturnsController extends Controller
{
    public function index()
    {
        $services = BlogCategory::where('parent_id', 0)->orderBy('position', 'asc')->get();
        $accordions = Service::where('parent_id', 0)->orderBy('created_at', 'asc')->get();

        return view('admin::admin.services.index', compact('services', 'accordions'));
    }

    public function store(Request $request)
    {
        $service = Service::create([
            'service_id' => $request->get('service_id'),
            'parent_id' => 0,
            'key' => $request->get('key'),
        ]);

        foreach ($this->langs as $key => $lang) {
            $service->translations()->create([
                'lang_id' => $lang->id,
                'title' => $request->get('title_'.$lang->lang)
            ]);
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $services = BlogCategory::where('parent_id', 0)->orderBy('position', 'asc')->get();
        $accordion = Service::findOrFail($id);

        return view('admin::admin.services.edit', compact('services', 'accordion'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update([
            'service_id' => $request->get('service_id'),
            'parent_id' => 0,
            'key' => $request->get('key'),
        ]);

        $service->translations()->delete();

        foreach ($this->langs as $key => $lang) {
            $service->translations()->create([
                'lang_id' => $lang->id,
                'title' => $request->get('title_'.$lang->lang)
            ]);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);

        $service->translations()->delete();
        $service->delete();

        return redirect()->back();
    }
}
