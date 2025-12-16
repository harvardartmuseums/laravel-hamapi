<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamMedium operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamMedium
 */
class HamMediumFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hammedium';
    }
}
