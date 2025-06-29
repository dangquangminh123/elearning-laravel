<?php

namespace Modules\Categories\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository) {
        $this->categoryRepository = $categoriesRepository;
    }

    public function index() {
        $pageTitle = 'Quản lý danh mục';
        // $categories = $this->categoryRepository->getTreeCategories()->toArray();
        return view('categories::lists', compact('pageTitle'));
    }
    public function data(Request $request) {
        $search = $request->input('search.value');

        $categories = $this->categoryRepository->getCategories(); // bạn đã có sẵn rồi
        $flattened = [];

        $this->getCategoriesTable($categories, '', $flattened, $search);

        return DataTables::of($flattened)
            ->rawColumns(['name', 'edit', 'delete', 'link'])
            ->escapeColumns([])
            ->make(true);
    }


    public function getCategoriesTable($categories, $char = '', &$result = [], $search = null)
    {
        foreach ($categories as $category) {
            $nameWithPrefix = $char . $category['name'];

            // Chỉ add nếu không search hoặc tên phù hợp
            if (!$search || stripos($category['name'], $search) !== false) {
                $result[] = [
                    'id' => $category['id'],
                    'name' => $nameWithPrefix,
                    'link' => '<a target="_blank" href="' . route('admin.categories.detail', $category['id']) . '" class="btn btn-info">Xem</a>',
                    'edit' => '<a href="' . route('admin.categories.edit', $category['id']) . '" class="btn btn-warning">Sửa</a>',
                    'delete' => '<a href="' . route('admin.categories.delete', $category['id']) . '" class="btn btn-danger delete-action">Xoá</a>',
                    'created_at' => Carbon::parse($category['created_at'])->format('d/m/Y H:i:s'),
                ];
            }

            // Đệ quy sub_categories
            if (!empty($category['sub_categories'])) {
                $this->getCategoriesTable($category['sub_categories'], $char . '|-- ', $result, $search);
            }
        }
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
