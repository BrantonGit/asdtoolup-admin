<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    //
    protected $table = "rewards";
    //image_url_lrg used to be celum_image_id
    //switched order of image_url and image_url_large
    //removed "mmm_id" inbetween list_price and rebate_value
    protected $fillable = ["name", "active", "redeemvalue", "description", "description_fr", "image_url", 'tier'];

    public function reward_options() {
    	return $this->hasMany('TradeInTradeUp\RewardOptions', 'rewardid');
    }
}
