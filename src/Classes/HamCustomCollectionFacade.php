<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollection operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamCustomCollection
 */
class HamCustomCollectionFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamcustomcollection';
    }
}
