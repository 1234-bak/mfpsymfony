<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\NewExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class NewExtension extends AbstractExtension
{
    public function getFilters(): array
    {
      
            return [
                new TwigFilter('defaultImage',[$this,'defaultImage'])
            ];
       
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [NewExtensionRuntime::class, 'defaultImage']),
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
