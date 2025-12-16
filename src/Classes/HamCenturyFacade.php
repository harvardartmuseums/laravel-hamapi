<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCentury operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamCentury
 */
class HamCenturyFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamcentury';
    }
}
