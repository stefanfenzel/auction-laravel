<?php

declare(strict_types=1);

namespace Gurulabs\Http\Auctions\Controllers;

use Exception;
use Gurulabs\Domain\Auctions\Auction;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class AuctionsController
{
    public function list(): View
    {
        // todo move to repository
        $auctions = Auction::where('end_date', '>', now())->get();

        return view('dashboard', ['auctions' => $auctions]);
    }

    // list auctions by user
    public function listByUser(Request $request): View
    {
        $userId = $request->user()->id;

        // todo move to repository
        $auctions = Auction::where('user_id', $userId)->get();

        return view('auctions', ['auctions' => $auctions]);
    }

    public function show(int $id)
    {
        // todo implement
    }

    public function create(Request $request)
    {
        $userId = $request->user()->id;

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_price' => 'required|numeric',
            'end_date' => 'required|date',
        ]);

        try {
            $auction = Auction::create([
                'user_id' => $userId,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_price' => $request->input('start_price'),
                'end_date' => $request->input('end_date'),
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create auction. Error: ' . $e->getMessage()], 500);
        }

        return response()->json($auction);
    }
}
