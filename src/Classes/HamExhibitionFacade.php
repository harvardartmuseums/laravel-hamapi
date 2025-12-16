<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamExhibition operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamExhibition
 */
class HamExhibitionFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamexhibition';
    }
}
