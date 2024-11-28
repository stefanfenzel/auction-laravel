<?php

declare(strict_types=1);

namespace Gurulabs\Http\Auctions\Controllers;

use Exception;
use Gurulabs\Domain\Auctions\Auction;
use Gurulabs\Domain\Offers\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

final class AuctionsController
{
    public function list(): View
    {
        // todo move to repository
        $auctions = Auction::where('end_date', '>', now())->get();

        return view('auctions.dashboard', ['auctions' => $auctions]);
    }

    // list auctions by user
    public function listByUser(Request $request): View
    {
        $userId = $request->user()->id;

        // todo move to repository
        $auctions = Auction::where('user_id', $userId)->get();

        return view('auctions.by-user', ['auctions' => $auctions]);
    }

    public function show($id): View
    {
        $auction = Auction::findOrFail($id);

        return view('auctions.show', ['auction' => $auction]);
    }

    public function create(): View
    {
        return view('auctions.create');
    }

    public function store(Request $request): RedirectResponse
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
            return back()->with('errors', 'Failed to create auction. Error: ' . $e->getMessage());
        }

        return redirect()->route('auctions.show', ['id' => $auction->id]);
    }

    public function placeBid(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;
        $auctionId = (int)$request->route('id');
        $amount = (float)$request->input('price');
        $auction = Auction::findOrFail($auctionId);
        $highestBid = $auction->highest_bid ?? $auction->start_price;

        $request->validate([
            'price' => 'required|numeric|gt:' . $highestBid,
        ]);

        try {
            // todo move to repository
            Offer::create([
                'auction_id' => $auctionId,
                'user_id' => $userId,
                'bid_amount' => $amount,
                'bid_time' => now(),
            ]);
        } catch (Exception $e) {
            $error = new MessageBag(
                ['errors' => 'Failed to place bid. Error: ' . $e->getMessage()]
            );

            return back()->with('errors', $error);
        }

        return back()->with('success', 'Bid placed successfully');
    }
}
