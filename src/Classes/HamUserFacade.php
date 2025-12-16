<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamUser operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamUser
 */
class HamUserFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamuser';
    }
}
