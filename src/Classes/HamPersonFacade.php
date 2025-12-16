<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPerson operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamPerson
 */
class HamPersonFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamperson';
    }
}
