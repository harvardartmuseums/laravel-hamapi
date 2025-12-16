<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPlace operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamPlace
 */
class HamPlaceFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamplace';
    }
}
