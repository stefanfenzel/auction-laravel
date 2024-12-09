<?php

namespace Gurulabs\Domain\Auctions;

use DateTimeImmutable;
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
    protected $guarded = ['*'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['id'] = $attributes['id'] ?? null;
        $this->attributes['user_id'] = $attributes['user_id'] ?? null;
        $this->attributes['title'] = htmlentities($attributes['title'] ?? null);
        $this->attributes['description'] = htmlentities($attributes['description'] ?? null);
        $this->attributes['start_price'] = $attributes['start_price'] ?? null;
        $this->attributes['end_date'] = $attributes['end_date'] ?? null;
    }

    /*public function setAttribute($key, $value): void
    {
        throw new RuntimeException("Attributes cannot be mutated directly in this model.");
    }*/

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

    public function changeTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return html_entity_decode($this->description);
    }

    public function changeDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getOffers(): Collection
    {
        return $this->offers()->orderBy('bid_amount', 'desc')->get();
    }

    public function changeStartPrice(float $startPrice): void
    {
        $this->start_price = $startPrice;
    }

    public function changeEndDate(DateTimeImmutable $endDate): void
    {
        $this->end_date = $endDate->format('Y-m-d H:i:s');
    }
}
