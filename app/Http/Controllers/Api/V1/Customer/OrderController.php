<?php
namespace App\Http\Controllers\Api\V1\Customer;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $s) { $this->orderService = $s; }

    public function index(Request $request) {
        return $request->user()->orders()->with('service')->latest()->paginate(10);
    }

    public function store(Request $request) {
        $request->validate(['service_id' => 'required|exists:services,id', 'quantity' => 'required|integer|min:1']);
        $service = Service::find($request->service_id);
        $total = $service->base_price * $request->quantity;
        
        $order = $this->orderService->createOrder(
            ['service_id' => $service->id, 'quantity' => $request->quantity, 'total_price' => $total, 'source' => 'web'],
            $request->input('details', []),
            $request->user()->id
        );
        return response()->json($order, 201);
    }
}
