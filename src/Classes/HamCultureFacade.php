<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamCulture operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamCulture
 */
class HamCultureFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamculture';
    }
}
