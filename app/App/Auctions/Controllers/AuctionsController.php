<?php

declare(strict_types=1);

namespace Gurulabs\App\Auctions\Controllers;

use DateTimeImmutable;
use Exception;
use Gurulabs\App\Auctions\ReadModel\AuctionDto;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
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
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:65535',
            'start_price' => 'required|numeric|min:1',
            'end_date' => 'required|date|after:today',
        ]);

        try {
            $auctionDto = new AuctionDto(
                $request->user()->id,
                htmlentities($request->input('title')),
                htmlentities($request->input('description')),
                (float)$request->input('start_price'),
                new DateTimeImmutable($request->input('end_date')),
            );
            $auction = $this->auctionRepository->save($auctionDto);
        } catch (Exception $e) {
            $error = new MessageBag(
                ['errors' => 'Failed to create auction. Error: ' . $e->getMessage()]
            );

            return back()->with('errors', $error);
        }

        return redirect()->route('auctions.show', ['id' => $auction->id]);
    }
}
