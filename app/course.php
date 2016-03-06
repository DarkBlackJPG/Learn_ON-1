<?php namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
	protected $table = 'courses';

    protected $fillable=[
		'title',
		'body',
		'published_at',
		'thumbnail'
	];

	protected $dates =['published_at'];

	/**
	 * Scope that displays the courses that have already been published
	 * @param $query
     */
	public function scopePublished($query)
	{
		$query->where('published_at','<=',Carbon::now());
	}

	/**
	 * A scope that shows courses that have a test and are done
	 * @param $query
     */
	public function scopeDone($query)
	{
		$query->where('done','=',1);
	}

	/**
	 * A scope that does not show the courses that are yet to be published
	 * @param $query
     */
	public function scopeUnpublished($query)
	{
		$query->where('published_at','>',Carbon::now());
	}

	/**
	 * A scope that does not show the course that does not have a test
	 * @param $query
     */
	public function scopeUndone($query)
	{
		$query->where('done','=',0);
	}

	/**
	 * A course can have many lectures
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function lectures()
	{
		return $this->hasMany('App\Lecture');
	}

	/**
	 * A course can have only one test
	 * @return mixed
     */
	public function test()
	{
		return $this->hasOne('App\Test');
	}

	/**
	 * Get the time that course was or wil be published at
	 * @param $date
     */
	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::parse($date);
	}

    /**
     * Get published_at attribute
     * @param $date
     * @return string
     */
    public function getPublishedAtAttribute($date)
	{
		return (new Carbon($date));
	}

	/**
	 * A course belongs to a user!
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the tags associated with the given course
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function tags()
	{
		return $this->belongsToMany('\App\Tag')->withTimestamps();
	}

	/**
	 * Get the list of tag IDs associated with the current course
	 * @return mixed
     */
	public function getTagListAttribute()
	{
		return $this->tags->lists('id')->toArray();
	}
}
