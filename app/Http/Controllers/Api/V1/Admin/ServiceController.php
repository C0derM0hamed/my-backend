<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required', 'base_price' => 'required|numeric', 
            'category' => 'required', 'unit_name' => 'required', 
            'unit_label' => 'required', 'service_type' => 'required', 'delivery_type' => 'required'
        ]);
        return Service::create($data);
    }
    public function index() { return Service::all(); }
}
