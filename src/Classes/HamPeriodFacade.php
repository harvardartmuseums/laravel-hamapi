<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamPeriod operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamPeriod
 */
class HamPeriodFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamperiod';
    }
}
