<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGallery operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamGallery
 */
class HamGalleryFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamgallery';
    }
}
