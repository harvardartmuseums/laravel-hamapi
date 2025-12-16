<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObject operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamObject
 */
class HamObjectFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamobject';
    }
}
