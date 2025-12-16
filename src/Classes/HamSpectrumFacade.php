<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum limit($limit = 50)
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum sort($sort = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum sortorder($sortorder = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum from($from = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum query($q = '')
 * @method static mixed find($id = '')
 * @method static mixed findCount()
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum usedby($group = '')
 * @method static \Harvardartmuseums\HamAPI\Classes\HamSpectrum operator($operator = 'AND')
 *
 * @see \Harvardartmuseums\HamAPI\Classes\HamSpectrum
 */
class HamSpectrumFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hamspectrum';
    }
}
