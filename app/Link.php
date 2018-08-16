<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Link extends Model implements Sortable
{
    protected $guarded = [];
    protected $appends = ['body_html'];
    protected $touches = ['trip'];

    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_id',
        'sort_when_creating' => true,
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

       public function linkType()
    {
        return $this->belongsTo(LinkType::class);
    }



    public function getBodyHtmlAttribute()
    {
        return \Markdown::text($this->linkinfo);
    }

   
}
