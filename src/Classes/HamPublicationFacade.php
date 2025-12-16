<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPublication operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamPublication
 */
class HamPublicationFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hampublication';
    }
}
