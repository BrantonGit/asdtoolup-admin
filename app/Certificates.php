<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    //
    protected $table = "certificates";
    //image_url_lrg used to be celum_image_id
    //switched order of image_url and image_url_large
    //removed "mmm_id" inbetween list_price and rebate_value
    protected $fillable = ["certid", "value", 'rewardid', 'optionid', 'userid', 'shipped', 'tracking', 'redeemed'];

    // public function purchases() {
    // 	return $this->hasMany('TradeInTradeUp\Payment_Section', 'id', 'category_id');
    // }


    public function author() {
    	return $this->hasOne('TradeInTradeUp\User', 'id', 'userid');
    }

    public function reward() {
    	return $this->hasOne('TradeInTradeUp\Rewards', 'id', 'rewardid');
    }

    public function option() {
    	return $this->hasOne('TradeInTradeUp\RewardOptions', 'id', 'optionid');
    }
}
