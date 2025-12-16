<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamColor operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamColor
 */
class HamColorFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamcolor';
    }
}
