<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\PromoSection;
use App\Models\Traduction;
use App\Models\Product;
use App\Models\TraductionTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;


class PromotionsController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('translation')->orderBy('position', 'asc')->get();

        return view('admin::admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin::admin.promotions.create');
    }

    public function store(Request $request)
    {
        $toValidate['title_'.$this->lang->lang] = 'required|max:255';
        $validator = $this->validate($request, $toValidate);

        $img = "";
        $img_mobile = "";

        if (!empty($request->file('img'))) {
            $img = time() . '-' . $request->img->getClientOriginalName();
            $request->img->move('images/promotions', $img);
        }

        if (!empty($request->file('img_mobile'))) {
            $img_mobile = time() . '-' . $request->img_mobile->getClientOriginalName();
            $request->img_mobile->move('images/promotions', $img_mobile);
        }

        $promotion = new Promotion();
        $promotion->alias = str_slug(request('title_'.$this->lang));
        $promotion->active = 1;
        $promotion->position = 1;
        $promotion->img = $img;
        $promotion->img_mobile = $img_mobile;
        $promotion->discount  = $request->discount;
        $promotion->save();

        foreach ($this->langs as $lang):
            $promotion->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('title_' . $lang->lang),
                'description' => request('description_' . $lang->lang),
                'body' => request('body_' . $lang->lang),
                'btn_text' => request('btn_text_' . $lang->lang),
                'seo_text' => request('seo_text_' . $lang->lang),
                'seo_title' => request('seo_title_' . $lang->lang),
                'seo_description' => request('seo_descr_' . $lang->lang),
                'seo_keywords' => request('seo_keywords_' . $lang->lang)
            ]);
        endforeach;

        Session::flash('message', 'New item has been created!');

        return redirect()->route('promotions.index');
    }

    public function show($id)
    {
        return redirect()->route('promotions.index');
    }

    public function edit($id)
    {
        $promotion = Promotion::with('translations')->findOrFail($id);

        return view('admin::admin.promotions.edit', compact('promotion', 'translations'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->file('video'));
        $toValidate['title_'.$this->lang->lang] = 'required|max:255';
        $validator = $this->validate($request, $toValidate);

        $img = $request->img_old;
        $img_mobile = $request->img_old_mobile;
        $videoName = $request->video_old;

        if (!empty($request->file('img'))) {
            $img = time() . '-' . $request->img->getClientOriginalName();
            $request->img->move('images/promotions', $img);
        }

        if (!empty($request->file('img_mobile'))) {
            $img_mobile = time() . '-' . $request->img_mobile->getClientOriginalName();
            $request->img_mobile->move('images/promotions', $img_mobile);
        }

        $promotion = Promotion::findOrFail($id);

        if (!$promotion->alias) {
            $promotion->alias = str_slug(request('title_en'));
        }

        if ($request->file('video')) {
            $videoName = uniqid().$request->file('video')->getClientOriginalName();
            $path = public_path().'/images/promotions/';
            $request->file('video')->move($path, $videoName);
        }

        $promotion->active = 1;
        $promotion->position = 1;
        $promotion->img = $img;
        $promotion->video = $videoName;
        $promotion->img_mobile = $img_mobile;
        $promotion->discount  = $request->discount;
        $promotion->save();

        $promotion->translations()->delete();

        foreach ($this->langs as $lang):
            $promotion->translations()->create([
                'lang_id' => $lang->id,
                'name' => request('title_' . $lang->lang),
                'description' => request('description_' . $lang->lang),
                'body' => request('body_' . $lang->lang),
                'btn_text' => request('btn_text_' . $lang->lang),
                'bot_message' => request('bot_message_' . $lang->lang),
                'seo_text' => request('seo_text_' . $lang->lang),
                'seo_title' => request('seo_title_' . $lang->lang),
                'seo_description' => request('seo_descr_' . $lang->lang),
                'seo_keywords' => request('seo_keywords_' . $lang->lang)
            ]);
        endforeach;

        // dd($request->all());
        foreach ($request->get('section_body') as $key => $section) {
            $checkSection = PromoSection::where('promotion_id', $id)->where('number', $key)->first();

            if (!is_null($checkSection)) {
                $checkSection->translations()->delete();
                foreach ($this->langs as $lang):
                    $checkSection->translations()->create([
                        'lang_id' => $lang->id,
                        'body' => $request->get('section_body')[$key][$lang->id],
                    ]);
                endforeach;
            }else{
                $promoSection = PromoSection::create([
                    'promotion_id' => $id,
                    'number' => $key,
                ]);

                foreach ($this->langs as $lang):
                    $promoSection->translations()->create([
                        'lang_id' => $lang->id,
                        'body' => $request->get('section_body')[$key][$lang->id],
                    ]);
                endforeach;
            }
        }

        if ($request->file('image_section')) {
            foreach ($request->file('image_section') as $number => $image) {
                $checkSection = PromoSection::where('promotion_id', $id)->where('number', $number)->first();
                if (!is_null($checkSection)) {
                    $imageSection = time() . '-' . $image->getClientOriginalName();
                    $image->move('images/promotions', $imageSection);
                    $checkSection->update([
                        'image' => $imageSection
                    ]);
                }
            }
        }

        return redirect()->back();
    }


    public function changePosition()
    {
        $neworder = Input::get('neworder');
        $i = 1;
        $neworder = explode("&", $neworder);

        foreach ($neworder as $k => $v) {
            $id = str_replace("tablelistsorter[]=", "", $v);
            if (!empty($id)) {
                Promotion::where('id', $id)->update(['position' => $i]);
                $i++;
            }
        }
    }

    public function status($id)
    {
        $promotion = Promotion::findOrFail($id);

        if ($promotion->active == 1) {
            $promotion->active = 0;
        } else {
            $promotion->active = 1;
        }

        $promotion->save();

        return redirect()->route('promotions.index');
    }


    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);

        foreach ($promotion->translations()->get() as $promotion_translation) {
            if ($promotion_translation->banner != '' && file_exists(public_path('images/promotions/'.$promotion_translation->banner))) {
                unlink(public_path('images/promotions/'.$promotion_translation->banner));
            }
            if ($promotion_translation->banner_mob != '' && file_exists(public_path('images/promotions/'.$promotion_translation->banner_mob))) {
                unlink(public_path('images/promotions/'.$promotion_translation->banner_mob));
            }
        }

        $promotion->delete();
        $promotion->translations()->delete();

        session()->flash('message', 'Item has been deleted!');

        return redirect()->route('promotions.index');
    }

    public function setAllStatus()
    {
        $settings = json_decode(file_get_contents(storage_path('settings.json')), true);

        if ($settings['promotions'] == 'active') {
            $settings['promotions'] = 'pasive';
        }else{
            $settings['promotions'] = 'active';
        }

        $file_handle = fopen(storage_path('settings.json'), 'w');
        fwrite($file_handle, json_encode($settings));
        fclose($file_handle);

        return redirect()->back();
    }

}
