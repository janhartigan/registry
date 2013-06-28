<?php
class Package extends Eloquent
{

	/**
	 * Get all of the Package's Maintainers
	 *
	 * @return Collection
	 */
	public function maintainers()
	{
		return $this->belongsToMany('Maintainer');
	}

	/**
	 * Get all of the Package's versions
	 *
	 * @return Collection
	 */
	public function versions()
	{
		return $this->hasMany('Version');
	}

	/**
	 * Get the informations of a package
	 *
	 * @return object
	 */
	public function getInformations()
	{
		return Cache::remember($this->name, 1440, function() {
			return App::make('packagist')->get($this->name);
		});
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get tags as an array
	 *
	 * @return array
	 */
	public function getTagsAttribute()
	{
		return (array) json_decode($this->getOriginal('tags'), true);
	}

	public function getMaintainersListAttribute()
	{
		$list = array();
		$maintainers = $this->maintainers;
		foreach ($maintainers as $maintainer) {
			$list[] = $maintainer->__toString();
		}

		return implode(', ', $list);
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////////// SCOPES ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Fetch only components
	 *
	 * @param  Query $query
	 *
	 * @return Query
	 */
	public function scopeComponent($query)
	{
		return $query->where('type', 'component');
	}

	/**
	 * Fetch only packages
	 *
	 * @param  Query $query
	 *
	 * @return Query
	 */
	public function scopePackage($query)
	{
		return $query->where('type', 'package');
	}

}