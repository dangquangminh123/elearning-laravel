<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRespo;

    public function __construct(ProductRepository $respositories) {
        $this->productRespo = $respositories;
    }
    public function index() {
        $product = $this->productRespo->getProduct();
    }
}
