<?php
namespace Harvardartmuseums\HamAPI;

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
            __DIR__. '/../config/debugbar.php' => config_path('hamapi.php'),
        ]);
    }
   
   
    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app->bind('hamapi', function ($app) {
            return new HamApi;
        });

        $this->app->bind('hamclass', function () {
            return new Classes\HamClass;
        });

        $this->app->bind('hamobject', function () {
            return new Classes\HamObject;
        });

        $this->app->bind('hamobjectentries', function () {
            return new Classes\HamObjectEntries;
        });

        $this->app->bind('hamexhibition', function () {
            return new Classes\HamExhibition;
        });

        $this->app->bind('hamgroup', function () {
            return new Classes\HamGroup;
        });

        $this->app->bind('hamperson', function () {
            return new Classes\HamPerson;
        });

        $this->app->bind('hampublication', function () {
            return new Classes\HamPublication;
        });

        $this->app->bind('hamgallery', function () {
            return new Classes\HamGallery;
        });

        $this->app->bind('hamplace', function () {
            return new Classes\HamPlace;
        });

        $this->app->bind('hamclassification', function () {
            return new Classes\HamClassification;
        });

        $this->app->bind('hamspectrum', function () {
            return new Classes\HamSpectrum;
        });

        $this->app->bind('hamperiod', function () {
            return new Classes\HamPeriod;
        });


        $this->app->bind('hamculture', function () {
            return new Classes\HamCulture;
        });

        $this->app->bind('hamcentury', function () {
            return new Classes\HamCentury;
        });

        $this->app->bind('hammedium', function () {
            return new Classes\HamMedium;
        });

        $this->app->bind('hamcustomcollection', function () {
            return new Classes\HamCustomCollection;
        });

        $this->app->bind('hamcustomcollectionvalue', function () {
            return new Classes\HamCustomCollectionValue;
        });

        $this->app->bind('hamtechnique', function () {
            return new Classes\HamTechnique;
        });

        $this->app->bind('hamcolor', function () {
            return new Classes\HamColor;
        });

        $this->app->bind('hamworktype', function () {
            return new Classes\HamWorktype;
        });

        $this->app->alias('HamApi', \Harvardartmuseums\HamAPI\HamApi::class);
    }
}
