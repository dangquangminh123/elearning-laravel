<?php
namespace App\Repositories\Product;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    // lấy model tương ứng
    public function getModel()
    {
    return Product::class;
    }
    public function getProduct()
    {
        return $this->model->select('product_name')->take(5)->get();
    }
}