<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'files';

    protected $fillable = ['id', 'name', 'file_name', 'size', 'rawsize', 'kind', 'folder', 'intake', 'confirmid', 'projectid', 'userid', 'updated_at', 'created_at'];

    protected $casts = [
        'removable' => 'boolean'
    ];


    public function submission() {
    	return $this->belongsTo('TradeInTradeUp\Submissions');
    }

}

