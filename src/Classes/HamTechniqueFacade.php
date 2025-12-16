<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamTechnique operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamTechnique
 */
class HamTechniqueFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamtechnique';
    }
}
