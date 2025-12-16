<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamClassification operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamClassification
 */
class HamClassificationFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamclassification';
    }
}
