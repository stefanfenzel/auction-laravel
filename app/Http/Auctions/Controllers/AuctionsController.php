<?php

declare(strict_types=1);

namespace Gurulabs\Http\Auctions\Controllers;

use DateTimeImmutable;
use Exception;
use Gurulabs\App\Auctions\ReadModel\AuctionDto;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class AuctionsController
{
    public function __construct(
        private AuctionRepositoryInterface $auctionRepository,
    ) {
    }

    public function list(): View
    {
        $auctions = $this->auctionRepository->findRunningAuctions();

        return view('auctions.dashboard', ['auctions' => $auctions]);
    }

    // list auctions by user
    public function listByUser(Request $request): View
    {
        $auctions = $this->auctionRepository->findByUserId($request->user()->id);

        return view('auctions.by-user', ['auctions' => $auctions]);
    }

    public function show($id): View
    {
        $auction = $this->auctionRepository->findById((int)$id);

        return view('auctions.show', ['auction' => $auction]);
    }

    public function create(): View
    {
        return view('auctions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_price' => 'required|numeric',
            'end_date' => 'required|date',
        ]);

        try {
            $auctionDto = new AuctionDto(
                $request->user()->id,
                $request->input('title'),
                $request->input('description'),
                $request->input('start_price'),
                new DateTimeImmutable($request->input('end_date')),
            );
            $auction = $this->auctionRepository->save($auctionDto);
        } catch (Exception $e) {
            return back()->with('errors', 'Failed to create auction. Error: ' . $e->getMessage());
        }

        return redirect()->route('auctions.show', ['id' => $auction->id]);
    }
}
