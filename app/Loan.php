<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'expiry',
        'status',
    ];

    protected $dates = ['expiry', 'returned_at'];

    public function close()
    {
        $this->returned_at = Carbon::now();
        $this->status = 'closed';
        $this->save();
    }

    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }

    /** Accessors */

    public function getClosedAttribute()
    {
        return $this->status == 'closed';
    }

    public function getActiveAttribute()
    {
        return $this->status == 'active';
    }

    public function getExpiredAttribute()
    {
        return $this->expiry->lt(Carbon::now());
    }

    public function getFineAttribute()
    {
        $now = Carbon::now();
        if($this->expiry->lt($now)){
            $days = ceil($this->expiry->diffInHours($now) / 24);
            return $days * config('liber.fine_per_day');
        }

        return 0;
    }

    /** Relationships */

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
