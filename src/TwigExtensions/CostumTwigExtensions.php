<?php
namespace TwigExtensions ;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class CustomTwigExtensions extends AbstractExtension{
    public function getFilters(){
        return [
            new TwigFilter('defaultImage',[$this,'defaultImage'])
        ];
    }

    public function defaultImage(string $path): string{
        if (strlen(trim($path)) == 0) {
            return 'kenza.jpeg';
        }else{
            return $path;
        }
    }

}