<?php

namespace Gurulabs\Domain\Auctions;

use Gurulabs\Domain\Offers\Offer;
use Gurulabs\Domain\Users\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Auction extends Model
{
    /** @use HasFactory<\Database\Factories\Domain\Auctions\AuctionFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'auctions';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'start_price',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'end_date' => 'datetime',
        ];
    }

    public function highestOffer(): float|null
    {
        $offer = $this->hasOne(Offer::class)->latest('bid_amount')->limit(1);

        if ($offer->exists() && $offer->first()->bid_amount > $this->start_price) {
            return $offer->first()->bid_amount;
        }

        return null;
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function isFinished(): bool
    {
        return now() > $this->end_date;
    }

    public function getTitle(): string
    {
        return html_entity_decode($this->title);
    }

    public function getDescription(): string
    {
        return html_entity_decode($this->description);
    }

    public function getOffers(): Collection
    {
        return $this->offers()->orderBy('bid_amount', 'desc')->get();
    }
}
