<?php
namespace App\Http\Controllers\Api;

use App\Tag;
use App\Article;
use App\RealWorld\Paginate\Paginate;
use App\RealWorld\Filters\ArticleFilter;
use App\Http\Requests\Api\CreateArticle;
use App\Http\Requests\Api\UpdateArticle;
use App\Http\Requests\Api\DeleteArticle;
use App\RealWorld\Transformers\ArticleTransformer;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Banner;
use App\Models\Promotion;
use App\Models\StaticPage;

class ServiceController extends ApiController
{
    public function initData(Request $request)
    {
        try {
            $this->swithLang($request->get('lang'));
        } catch (\Exception $e) {
            return $this->respondError("Language is not found", 500);
        }

        $data['services'] = BlogCategory::with(
                        [
                            'children.translation',
                            'subcategories.translation',
                            'services.translation',
                            'services.children.translation',
                            'translation'
                        ])
                            ->where('parent_id', 0)
                            ->orderby('position', 'asc')
                            ->get();

        $data['servicesAll'] = BlogCategory::with(
                            [
                                'children.translation',
                                'children.blogs.translation:blog_id,id,body,name',
                                'translation',
                                'blogs.translation:blog_id,id,body,name',
                                'services.translation',
                                'services.children.translation',
                            ])
                                ->orderby('position', 'asc')
                                ->get();

        $data['banners'] = Banner::get();


        $data['promotions'] = Promotion::with(['translation', 'promoSections.translation'])
                                ->where('active', 1)
                                ->orderBy('id', 'desc')
                                ->get();

        $data['pages'] = StaticPage::with(['translation'])->get();


        return $this->respond($data);
    }

    public function all($lang)
    {
        try {
            $this->swithLang($lang);
        } catch (\Exception $e) {
            return $this->respondError("Language is not found", 500);
        }

        $services = BlogCategory::with(['children.translation', 'translation'])
                            ->where('parent_id', 0)
                            ->orderby('position', 'asc')
                            ->get();

        return $this->respond($services);
    }

    public function getOneService(Request $request)
    {
        return $this->respond('ok');

        try {
            $this->swithLang($request->get('lang'));
        } catch (\Exception $e) {
            return $this->respondError("Language is not found", 500);
        }

        $service = BlogCategory::with(['children.translation', 'translation'])
                            ->where('id', $request->id)
                            ->first();

        return $this->respond($service);
    }

    /**
     * Get all the articles.
     *
     * @param ArticleFilter $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ArticleFilter $filter)
    {
        $articles = new Paginate(Article::loadRelations()->filter($filter));

        return $this->respondWithPagination($articles);
    }

    /**
     * Create a new article and return the article if successful.
     *
     * @param CreateArticle $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateArticle $request)
    {
        $user = auth()->user();

        $article = $user->articles()->create([
            'title' => $request->input('article.title'),
            'description' => $request->input('article.description'),
            'body' => $request->input('article.body'),
        ]);

        $inputTags = $request->input('article.tagList');

        if ($inputTags && ! empty($inputTags)) {

            $tags = array_map(function($name) {
                return Tag::firstOrCreate(['name' => $name])->id;
            }, $inputTags);

            $article->tags()->attach($tags);
        }

        return $this->respondWithTransformer($article);
    }

    /**
     * Get the article given by its slug.
     *
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $article)
    {
        return $this->respondWithTransformer($article);
    }

    /**
     * Update the article given by its slug and return the article if successful.
     *
     * @param UpdateArticle $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticle $request, Article $article)
    {
        if ($request->has('article')) {
            $article->update($request->get('article'));
        }

        return $this->respondWithTransformer($article);
    }

    /**
     * Delete the article given by its slug.
     *
     * @param DeleteArticle $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteArticle $request, Article $article)
    {
        $article->delete();

        return $this->respondSuccess();
    }
}
