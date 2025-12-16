<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTour operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamTour
 */
class HamTourFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamtour';
    }
}
