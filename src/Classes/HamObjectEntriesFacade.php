<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamObjectEntries operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamObjectEntries
 */
class HamObjectEntriesFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamobjectentries';
    }
}
