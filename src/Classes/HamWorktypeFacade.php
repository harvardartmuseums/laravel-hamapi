<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamWorktype operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamWorktype
 */
class HamWorktypeFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamworktype';
    }
}
