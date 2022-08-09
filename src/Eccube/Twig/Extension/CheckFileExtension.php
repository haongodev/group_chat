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
    public function ext($filename,$chat_info_id,$parent_id,$baseUrl){
        $allowed = ['gif', 'png', 'jpg'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            return '';
        }
        $result = '/html/upload/strage/'.$parent_id.'/chat/'. $chat_info_id .'/'.$filename;
        if (file_exists($baseUrl.$result)){
            return $result;
        }else{
            return 'has_been_deleted';
        }
    }
}
