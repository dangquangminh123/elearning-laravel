<?php

namespace Modules\Cart\src\Http\Controllers;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CartController extends Controller
{
    protected $coursesRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository)
    {
       $this->coursesRepository = $coursesRepository;
    }

    public function add(Request $request)
    {
        $courseId = $request->input('course_id');
        $course = $this->coursesRepository->getCourse($courseId);

        if (!$course) {
            return response()->json(['success' => false, 'message' => __('cart::messages.notfound')]);
        }

        $finalPrice = ($course->sale_price && $course->sale_price < $course->price)
        ? $course->sale_price
        : $course->price;

        $cart = session()->get('cart', []);

       
        $cart[$courseId] = [
            'id' => $course->id,
            'slug' => $course->slug,
            'name' => $course->name,
            'sale_price' => $finalPrice,
            'thumbnail' => $course->thumbnail,
            'teacher_name' => $course->teacher->name ?? null,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
        ]);
    }

    public function getPopupItems()
    {
        $cart = session()->get('cart', []);

        $items = collect($cart)->map(function ($item) {
            return [
                'name' => Str::limit($item['name'], 25),
                'price' => number_format($item['sale_price']),
            ];
        })->values();

        return response()->json([
            'items' => $items,
            'count' => count($cart)
        ]);
    }
    
    public function list() {
        $pageTitle = 'Giỏ hàng';
        $cart = session()->get('cart', []);
        return view('cart::lists', compact('pageTitle', 'cart'));
    }

    public function remove(Request $request)
    {
        $courseId = $request->input('course_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$courseId])) {
            unset($cart[$courseId]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
        ]);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'cart_count' => 0,
        ]);
    }
}