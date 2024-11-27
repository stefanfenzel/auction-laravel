<?php

namespace Gurulabs\Domain\Offers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\Domain\Offers\OfferFactory> */
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'auction_id',
        'user_id',
        'bid_amount',
        'bid_time',
    ];
}
