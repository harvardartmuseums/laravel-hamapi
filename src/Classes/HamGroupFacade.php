<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamGroup operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamGroup
 */
class HamGroupFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamgroup';
    }
}
