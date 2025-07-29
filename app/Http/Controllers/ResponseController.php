<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequest;
use App\Models\SellerResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function index()
    {
        $responses = Auth::user()->responses()
            ->with(['request', 'request.city'])
            ->latest()
            ->paginate(10);
            
        return view('responses.index', compact('responses'));
    }

    public function store(Request $request, CustomerRequest $customerRequest)
    {
        $validated = $request->validate([
            'response_text' => 'required|string',
            'file' => 'nullable|file|max:2048',
            'responded_items' => 'required|array',
            'responded_items.*' => 'exists:customer_request_items,id',
        ]);
    
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public/response_files');
        }
    
        $response = SellerResponse::create([
            'customer_request_id' => $customerRequest->id,
            'user_id' => Auth::id(),
            'response_text' => $validated['response_text'],
            'file_path' => $filePath,
            'responded_items' => $validated['responded_items'],
            'status' => 'new',
        ]);
    
        return response()->json(['success' => true, 'message' => 'Отклик успешно отправлен']);
    }

    public function update(Request $request, SellerResponse $response)
    {
        $validated = $request->validate([
            'status' => 'required|in:completed,canceled',
        ]);

        $response->update(['status' => $validated['status']]);
        
        return back()->with('success', 'Статус отклика обновлен');
    }
}