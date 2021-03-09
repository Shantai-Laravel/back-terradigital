<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Page;
use App\Models\Gallery;
use App\Models\SetGallery;
use App\Models\Team;
use App\Models\Department;

class TeamController extends Controller
{
    public function index()
    {
        $team = Team::get();
        $departments = Department::get();

        return view('admin::admin.team.index', compact('team', 'departments'));
    }

    public function create()
    {
        $departments = Department::get();

        return view('admin::admin.team.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $toValidate['name_'.$this->lang->lang] = 'required|max:255';
        $validator = $this->validate($request, $toValidate);
        $image = "";

        if ($request->image) {
            $image = uniqid() . '-' . $request->image->getClientOriginalName();
            $request->image->move('images/team', $image);
        }

        $team = new Team();
        $team->alias = str_slug(request('name_'.$this->lang->lang) ?? uniqid());
        $team->image = $image;
        $team->department_id = request('department_id');
        $team->save();

        foreach ($this->langs as $lang):
            $team->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('name_' . $lang->lang) ?? request('name_en'),
                'function' => request('function_' . $lang->lang) ?? request('function_en'),
                'email' => request('email_' . $lang->lang) ?? request('email_en'),
                'phone' => request('phone_' . $lang->lang) ?? request('phone_en'),
                'info' => request('info_' . $lang->lang) ?? request('info_en'),
            ]);
        endforeach;

        return redirect()->route('team.index');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $departments = Department::get();

        return view('admin::admin.team.edit', compact('team', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $toValidate['name_'.$this->lang->lang] = 'required|max:255';
        $validator = $this->validate($request, $toValidate);

        $image = $request->image_old;

        if ($request->image) {
            $image = uniqid() . '-' . $request->image->getClientOriginalName();
            $request->image->move('images/team', $image);
            if ($team->image) {
                @unlink(public_path('images/team/'.$team->image));
            }
        }

        $team->image = $image;
        $team->department_id = request('department_id');
        $team->save();

        $team->translations()->delete();

        foreach ($this->langs as $lang):
            $team->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('name_' . $lang->lang) ?? request('name_en'),
                'function' => request('function_' . $lang->lang) ?? request('function_en'),
                'email' => request('email_' . $lang->lang) ?? request('email_en'),
                'phone' => request('phone_' . $lang->lang) ?? request('phone_en'),
                'info' => request('info_' . $lang->lang) ?? request('info_en'),
            ]);
        endforeach;

        return redirect()->back();
    }


    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        @unlink('/images/team/' . $team->image);

        $team->delete();

        return redirect()->route('team.index');
    }


    public function addNewDepartment(Request $request)
    {
        $alias = str_slug($request->get('title_en') ?? uniqid());

        $department = Department::create([
            'alias' => $alias
        ]);

        foreach ($this->langs as $key => $lang) {
            $department->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('title_' . $lang->lang),
            ]);
        }

        return redirect()->back();
    }

    public function editDepartment(Request $request)
    {
        $department = Department::findOrFail($request->get('department_id'));

        $department->translations()->delete();

        foreach ($this->langs as $key => $lang) {
            $department->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('title_' . $lang->lang),
            ]);
        }

        return redirect()->back();
    }

    public function removeDepartment($id)
    {
        $department = Department::findOrFail($id);

        Team::where('department_id', $id)->update(['department_id' => 0]);

        $department->translations()->delete();
        $department->delete();

        return redirect()->back();
    }

}
