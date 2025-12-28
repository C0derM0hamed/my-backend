<?php
namespace App\Http\Controllers\Api\V1\Public;
use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() { return Service::where('is_active', true)->paginate(15); }
    public function show($id) { return Service::with('images')->findOrFail($id); }
}
