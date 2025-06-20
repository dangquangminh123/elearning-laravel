<?php

namespace Modules\Categories\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Yajra\DataTables\Facades\DataTables;
use  Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoriesRepository $categoriesRepository) {
        $this->categoryRepository = $categoriesRepository;
    }

    public function index() {

        $pageTitle = 'Quản lý danh mục';
        // $categories = $this->categoryRepository->getTreeCategories()->toArray();
        return view('categories::lists', compact('pageTitle'));
    }
    public function data() {
        $categories = $this->categoryRepository->getCategories();
        
        $categories = DataTables::of($categories)
        //     ->addColumn('edit', function($category) {
        //         return '<a href="'.route('admin.categories.edit', $category).'" class="btn btn-warning">Sửa</a>';
        //     })
        //     ->addColumn('delete', function($category) {
        //         return '<a href="'.route('admin.categories.delete', $category).'" class="btn btn-danger delete-action">Xoá</a>';
        //     })
        //     ->addColumn('link', function($category) {
        //         return '<a href="'.route('admin.categories.detail', $category).'" class="btn btn-info delete-action">Xem</a>';
        //     })
        //     ->editColumn('created_at', function ($category) {
        //         return Carbon::parse($category->created_at)->format('d/m/Y H:i:s');
        //     })
        // ->rawColumns(['edit', 'delete', 'link'])
        ->toArray();

        $categories['data'] = $this->getCategoriesTable($categories['data']);
        return $categories;
    }

    public function getCategoriesTable($categories, $char='', &$result=[]) {
        if(!empty($categories)) {
            foreach($categories as $key => $category) {
                $row = $category;
                $row['name'] = $char.$row['name'];
                $row['edit'] = '<a href="'.route('admin.categories.edit', $category['id']).'" class="btn btn-warning">Sửa</a>';
                $row['delete'] = '<a href="'.route('admin.categories.delete', $category['id']).'" class="btn btn-warning">Xoá</a>';
                $row['detail'] = '<a target="_blank" href="'.route('admin.categories.detail', $category['id']).'" class="btn btn-warning">Xem</a>';
                $row['created_at'] = Carbon::parse($category['created_at'])->format('d/m/Y H:i:s');
                unset($row['sub_categories']);
                unset($row['updated_at']);

                $result[] = $row;
                if(!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char.'|--',$result);
                }
            }
        }
        return $result;
    }

    public function store(CategoryRequest $request) {
        $this->categoryRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route(route: 'admin.categories.index')->with('msg',__('categories::messages.create.success'));
    }

    public function edit($id) {
        $category = $this->categoryRepository->find($id);
        $pageTitle = 'Cập nhập danh mục';

        if(!$category) {
            abort(404);
        }

        $categories = $this->categoryRepository->getAllCategories();

        return view('categories::edit', compact('category', 'pageTitle', 'categories'));
    }

    public function update(CategoryRequest $categoryRequest, $id) {

        $data = $categoryRequest->except('_token');

       
        $this->categoryRepository->update($id, $data);

        return back()->with('msg',__('categories::messages.update.success'));
    }

   

     public function create() {
        $pageTitle = 'Thêm mới danh mục';

        $categories = $this->categoryRepository->getAllCategories();
        return view('categories::add', compact('pageTitle', 'categories'));
    }

    public function delete($id) {
        $this->categoryRepository->delete($id);
        return back()->with('msg',__('categories::messages.delete.success'));
    }

    public function detail($id) {
        return 'detail';
    }
}
