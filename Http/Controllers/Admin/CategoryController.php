<?php namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Modules\Blog\Entities\Category;
use Modules\Blog\Http\Requests\StoreCategoryRequest;
use Modules\Blog\Http\Requests\UpdateCategoryRequest;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return View::make('blog::admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('blog::admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoryRequest $request
     * @return Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category->create($request->all());

        Flash::success(trans('blog::messages.category created'));

        return Redirect::route('dashboard.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return View::make('blog::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category              $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        Flash::success(trans('blog::messages.category updated'));

        return Redirect::route('dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->category->destroy($category);

        Flash::success(trans('blog::messages.category deleted'));

        return Redirect::route('dashboard.category.index');
    }
}
