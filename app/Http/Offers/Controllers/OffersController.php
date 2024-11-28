<?php

declare(strict_types=1);

namespace Gurulabs\Http\Offers\Controllers;

use DateTimeImmutable;
use Exception;
use Gurulabs\App\Offers\ReadModel\OfferDto;
use Gurulabs\Domain\Auctions\AuctionRepositoryInterface;
use Gurulabs\Domain\Offers\OfferRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

final readonly class OffersController
{
    public function __construct(
        private AuctionRepositoryInterface $auctionRepository,
        private OfferRepositoryInterface $offerRepository,
    ) {
    }

    public function placeBid(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;
        $auctionId = (int)$request->route('id');
        $amount = (float)$request->input('price');
        $auction = $this->auctionRepository->findById($auctionId);
        $highestBid = $auction->highestOffer() ?? $auction->start_price;

        $request->validate([
            'price' => 'required|numeric|gt:' . $highestBid,
        ]);

        try {
            $offerDto = new OfferDto(
                $auctionId,
                $userId,
                $amount,
                new DateTimeImmutable(),
            );
            $this->offerRepository->save($offerDto);
        } catch (Exception $e) {
            $error = new MessageBag(
                ['errors' => 'Failed to place bid. Error: ' . $e->getMessage()]
            );

            return back()->with('errors', $error);
        }

        return back()->with('success', 'Bid placed successfully');
    }
}
