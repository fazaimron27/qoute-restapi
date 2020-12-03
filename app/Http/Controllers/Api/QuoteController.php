<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->paginate(10);

        return QuoteResource::collection($quotes);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);

        $quote = Quote::create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        return new QuoteResource($quote);
    }

    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    public function update(Request $request, Quote $quote)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);

        $this->authorize('update', $quote);

        $quote->update([
            'message' => $request->message
        ]);

        return (new QuoteResource($quote))->additional([
            'meta' => [
                'updated' => $quote->updated_at->diffForHumans()
            ]
        ]);
    }

    public function destroy(Quote $quote)
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return response()->json([
            'message' => 'Quote Deleted',
        ]);
    }
}
