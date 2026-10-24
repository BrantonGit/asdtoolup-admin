<?php

namespace TradeInTradeUp;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'password', 'email', 'role', 'phone', 'address', 'profession', 'company', 'city', 'postal', 'notifications', 'tiervalue'
    ];

        

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function token(){
        return $this->hasMany(Token::class);
    }

    public function subs() {
        return $this->hasMany('TradeInTradeUp\Submissions', 'customer_id');
    }


}
