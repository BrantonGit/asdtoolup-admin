<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class RewardOptions extends Model
{
    //
    protected $table = "reward_options";
    //image_url_lrg used to be celum_image_id
    //switched order of image_url and image_url_large
    //removed "mmm_id" inbetween list_price and rebate_value
    protected $fillable = ["rewardid", "model", "diameter", "orbit", "discpad", 'motor', 'rpm'];

    public function reward() {
        return $this->hasOne('TradeInTradeUp\RewardOptions', 'rewardid');
    }
}
