<?php
namespace Harvardartmuseums\HamAPI\Providers;

use Illuminate\Support\ServiceProvider;

class HamApiServiceProvider extends ServiceProvider
{

  /**
   * Register the service provider.
   *
   * @return void
   */
    public function boot()
    {
        $this->publishes([
            __DIR__. '/../config/hamapi.php' => config_path('hamapi.php'),
        ]);
    }
   
   
    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app->bind('hamapi', function ($app) {
            return new HamApi;
        });

        $this->app->bind('hamclass', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamClass;
        });

        $this->app->bind('hamobject', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamObject;
        });

        $this->app->bind('hamobjectentries', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamObjectEntries;
        });

        $this->app->bind('hamexhibition', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamExhibition;
        });

        $this->app->bind('hamgroup', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamGroup;
        });

        $this->app->bind('hamperson', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamPerson;
        });

        $this->app->bind('hampublication', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamPublication;
        });

        $this->app->bind('hamgallery', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamGallery;
        });

        $this->app->bind('hamplace', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamPlace;
        });

        $this->app->bind('hamclassification', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamClassification;
        });

        $this->app->bind('hamspectrum', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamSpectrum;
        });

        $this->app->bind('hamperiod', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamPeriod;
        });


        $this->app->bind('hamculture', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamCulture;
        });

        $this->app->bind('hamcentury', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamCentury;
        });

        $this->app->bind('hammedium', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamMedium;
        });

        $this->app->bind('hamcustomcollection', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamCustomCollection;
        });

        $this->app->bind('hamcustomcollectionvalue', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamCustomCollectionValue;
        });

        $this->app->bind('hamtechnique', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamTechnique;
        });

        $this->app->bind('hamcolor', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamColor;
        });

        $this->app->bind('hamworktype', function () {
            return new \Harvardartmuseums\HamAPI\Classes\HamWorktype;
        });

        $this->app->alias('HamApi', \Harvardartmuseums\HamAPI\HamApi::class);
    }
}
