<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue
 */
class HamCustomCollectionValueFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamcustomcollectionvalue';
    }
}
