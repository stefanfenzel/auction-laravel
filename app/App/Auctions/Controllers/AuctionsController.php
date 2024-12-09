<?php

declare(strict_types=1);

namespace Gurulabs\App\Auctions\Controllers;

use DateTimeImmutable;
use Exception;
use Gurulabs\Domain\Auctions\Auction;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Domain\Uuid;
use Gurulabs\Domain\UuidFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

final readonly class AuctionsController
{
    public function __construct(
        private AuctionRepositoryInterface $auctionRepository,
        private UuidFactory $uuidFactory,
    ) {
    }

    public function home(): View
    {
        $auctions = $this->auctionRepository->findRunningAuctions();

        return view('auctions.home', ['auctions' => $auctions]);
    }

    public function list(): View
    {
        $auctions = $this->auctionRepository->findRunningAuctions();

        return view('auctions.dashboard', ['auctions' => $auctions]);
    }

    public function listByUser(Request $request): View
    {
        $auctions = $this->auctionRepository->findByUserId($request->user()->id);

        return view('auctions.by-user', ['auctions' => $auctions]);
    }

    public function show(string $id): View
    {
        $auction = $this->auctionRepository->findById(Uuid::fromString($id));

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
            $auction = new Auction([
                $this->uuidFactory->create()->toString(),
                $request->user()->id,
                $request->input('title'),
                $request->input('description'),
                (float)$request->input('start_price'),
                new DateTimeImmutable($request->input('end_date')),
            ]);
            $this->auctionRepository->save($auction);
        } catch (Exception $e) {
            $error = new MessageBag(
                ['errors' => 'Failed to create auction. Error: ' . $e->getMessage()]
            );

            return back()->with('errors', $error);
        }

        return redirect()->route('auctions.show', ['id' => $auction->id]);
    }

    public function delete(string $id): RedirectResponse
    {
        $this->auctionRepository->delete(Uuid::fromString($id));

        return redirect()->route('auctions.list');
    }

    public function edit(string $id): View|RedirectResponse
    {
        $auction = $this->auctionRepository->findById(Uuid::fromString($id));

        if ($auction->user_id !== auth()->id()) {
            $errors = new MessageBag(['errors' => 'You are not allowed to edit this auction.']);

            return redirect()->route('dashboard')->with('errors', $errors);
        }

        return view('auctions.edit', ['auction' => $auction]);
    }

    public function update(Request $request): RedirectResponse
    {
        $id = $request->route('id');
        $auction = $this->auctionRepository->findById(Uuid::fromString($id));

        if ($auction->user_id !== $request->user()->id) {
            return redirect()->route('auctions.list');
        }

        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:65535',
            'start_price' => 'required|numeric|min:1',
            'end_date' => 'required|date|after:today',
        ]);

        try {
            $auction->changeTitle($request->input('title'));
            $auction->changeDescription($request->input('description'));
            $auction->changeStartPrice((float)$request->input('start_price'));
            $auction->changeEndDate(new DateTimeImmutable($request->input('end_date')));
            $this->auctionRepository->save($auction);
        } catch (Exception $e) {
            $error = new MessageBag(
                ['errors' => 'Failed to update auction. Error: ' . $e->getMessage()]
            );

            return back()->with('errors', $error);
        }

        return redirect()->route('auctions.show', ['id' => $auction->id]);
    }
}
