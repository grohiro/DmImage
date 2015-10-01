<?php

class Dm_Image_Filter_Chain extends Dm_Image_Filter_Abstract
{
	private $filters;

	/**
	 * Create new filter chain
	 *
	 * @return Dm_Image_Filter_Chain
	 */
	public static function create()
	{
		return new Dm_Image_Filter_Chain();
	}

	/**
	 * Filter chain constructor
	 *
	 * @param array $filters Dm_Image_Filter_Abstract
	 * @return Dm_Image_Filter_Chain
	 */
	public function __construct(array $filters = [])
	{
		$this->filters = is_array($filters) ? $filters : [];
	}

	/**
	 * Crop image
	 *
	 * @param int $width
	 * @param int $height
	 * @param boolean $bounding 
	 * @return $this
	 */
	public function crop($width, $height)
	{
		$this->filters[] = new Dm_Image_Filter_Crop($width, $height);
		return $this;
	}

	/**
	 * Fit image
	 *
	 * @param int $width
	 * @param int $height
	 * @param boolean $bounding 
	 * @return $this
	 */
	public function fit($width, $height, $bounding = false)
	{
		$this->filters[] = new Dm_Image_Filter_Fit($width, $height, $bounding);
		return $this;
	}

	/**
	 * Apply filters
	 *
	 * @param DmImage
	 * @return bool
	 */
	public function execute(Dm_Image $image)
	{
		foreach ($this->filters as $filter) {
			$image->applyFilter($filter);
		}
		return $image->getImageResource();
	}
}

