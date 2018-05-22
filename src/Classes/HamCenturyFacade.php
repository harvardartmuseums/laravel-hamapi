<?php namespace Harvardartmuseums\HamAPI\Classes;

use Illuminate\Support\Facades\Facade;

class HamCenturyFacade extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
    protected static function getFacadeAccessor()
    {
        return 'hamcentury';
    }
}
