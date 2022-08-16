<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eccube\Twig\Extension;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CheckFileExtension extends AbstractExtension
{
    /**
     * Returns a list of filters.
     *
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('ext', [$this, 'ext']),
        ];
    }
    public function ext($filename){
        $allowed = ['jpeg', 'png', 'jpg'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), $allowed)) {
            return true;
        }else{
            return false;
        }
    }
}
