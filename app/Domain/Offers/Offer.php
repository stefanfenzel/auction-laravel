<?php

namespace Gurulabs\Domain\Offers;

use Gurulabs\Domain\Auctions\Auction;
use Gurulabs\Domain\Users\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\Domain\Offers\OfferFactory> */
    use HasFactory;
    use HasUuids;
    protected $table = 'offers';

    protected $fillable = [
        'id',
        'auction_id',
        'user_id',
        'bid_amount',
        'bid_time',
    ];

    public $timestamps = false;

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'bid_time' => 'datetime',
        ];
    }
}
