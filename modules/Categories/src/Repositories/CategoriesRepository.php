<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    // public function getCategories() {
    //     return $this->model->with('subCategories')->whereParentId(0)->select(['id', 'name', 'slug', 'parent_id', 'created_at'])->latest();
    // }

    public function getCategories()
    {
        return $this->model
            ->with('subCategories')
            ->whereParentId(0)
            ->select(['id', 'name', 'slug', 'parent_id', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray(); // Bắt buộc phải toArray để xử lý phân cấp
    }
    public function getAllCategories() {
        return $this->getAll();
    }

}