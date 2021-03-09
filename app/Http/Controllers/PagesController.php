<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Collection;
use App\Models\StaticPage;
use App\Models\BlogCategory;
use App\Models\FeedBack;
use App\Models\Team;
use App\Models\Department;
use Session;

class PagesController extends Controller
{
    /***********************************  Render Methods ***********************
    *
    *  Render home page
    */
    public function index()
    {
        $categories = ProductCategory::where('active', 1)->where('on_home', 1)->orderBy('position', 'asc')->get();
        $seoData = $this->getPageByAlias('home');

        return view('front.home', compact('seoData', 'categories'));
    }

    /**
     * Render the start page
     */
     public function general()
     {
         $seoData = $this->getPageByAlias('home');
         return view('front.general', compact('seoData'));
     }

    /**
     *  Render dynamic pages by alias
     */
    public function getPages($slug)
    {
        if (@$_COOKIE['country_id'] == 140) {
            if ($slug == "contacts") {
                $slug = "contacts-md";
            }
        }

        // dd($slug);

        $seoData = $this->getPageByAlias($slug);

        $page = Page::where('alias', $slug)->first();
        $staticPage = StaticPage::where('alias', $slug)->first();

        if (!is_null($staticPage)) {
            $page = $staticPage;
            if (@$_COOKIE['country_id'] == 140) {
                $staticPage = StaticPage::where('alias', $slug.'_md')->first();
                if (!is_null($staticPage)) {
                    $page = $staticPage;
                }
            }
        }

        $faq = FeedBack::where('status', 'cloose')->get();
        $branches = Brand::get();
        $team = Team::where('department_id', 0)->get();
        $departments = Department::get();

        if (view()->exists('front/pages/'.$slug)) {
            return view('front.pages.'.$slug, compact('seoData', 'page', 'faq', 'branches', 'departments', 'team'));
        }else{
            return view('front.pages.default', compact('seoData', 'page', 'faq', 'branches', 'departments', 'team'));
        }
    }

    /**
     *  Render 404 page
     */
    public function get404()
    {
        return view('front.404');
    }


    public function resourcesListRender($alias)
    {
        // render Tabs
        $resource = BlogCategory::where('alias', $alias)->where('type', 'tabs')->first();
        if (is_null($resource)) abort(404);

        $seoData['title'] = $resource->translation($this->lang->id)->first()->seo_title;
        $seoData['keywords'] = $resource->translation($this->lang->id)->first()->seo_keywords;
        $seoData['description'] = $resource->translation($this->lang->id)->first()->seo_description;

        return view('front.resources.tabsList', compact('seoData', 'resource', 'seoData'));
    }

    public function resourcesRender($alias)
    {
        // render Accordions
        $resource = BlogCategory::where('alias', $alias)->where('type', 'accordion')->first();
        if (is_null($resource)) abort(404);

        $seoData['title'] = $resource->translation($this->lang->id)->first()->seo_title;
        $seoData['keywords'] = $resource->translation($this->lang->id)->first()->seo_keywords;
        $seoData['description'] = $resource->translation($this->lang->id)->first()->seo_description;

        return view('front.resources.accordion', compact('seoData', 'resource', 'seoData'));
    }

    /**
     * Get page data by alias
     */
    public function getPageByAlias($alias)
    {
        $page = Page::where('alias', $alias)->first();
        if (is_null($page)) abort(404);

        return $this->getSeo($page);
    }

    public function getOopsPage(Request $request)
    {
        Session::flash('disableForward', true);
        return view('front.dynamic.oops');
    }

    /**
     *  Get seo datas of pages
     */
    public function getSeo($page)
    {
        $seo['title'] = $page->translation($this->lang->id)->first()->meta_title ?? $page->translation($this->lang->id)->first()->title;
        $seo['keywords'] = $page->translation($this->lang->id)->first()->meta_keywords ?? $page->translation($this->lang->id)->first()->title;
        $seo['description'] = $page->translation($this->lang->id)->first()->meta_description ?? $page->translation($this->lang->id)->first()->title;

        return $seo;
    }
}
