<?php

namespace HelloWorld\Scheduler;

use Bitrix\Main\Context;
use Bitrix\Main\SiteTable;
use Bitrix\Main\Web\Json;
use Bitrix\Main\IO\File;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

class Tools
{

    public static function getModuleName()
    {
        return 'helloworld.scheduler';
    }

    public static function jsonEncode($json)
    {
        return Json::encode($json);
    }

    public static function getSiteId()
    {
        return Context::getCurrent()->getSite();
    }

    public static function getSitesList($siteId = '')
    {

        $site_arr = SiteTable::getList([
            'select' => ['*'],
            'filter' => ($siteId ? ['=LID' => $siteId] : []),
        ])->fetchAll();

        return $site_arr;
    }

    public static function getLanguageId()
    {
        return Context::getCurrent()->getLanguage();
    }

    public static function showIconSvg($class = 'phone', $path, $title = '', $classIcon = '', $showWrapper = true)
    {
        $text ='';
        if(self::checkContentFile($path))
        {
            static $svg_call;
            $iSvgID = ++$svg_call;
            if($showWrapper)
                $text = '<i class="svg inline '.$classIcon.' svg-inline-'.$class.'" aria-hidden="true" '.($title ? 'title="'.$title.'"' : '').'>';

            $text .= str_replace('markID', $iSvgID, File::getFileContents($path));

            if($showWrapper)
                $text .= '</i>';
        }

        return $text;
    }

    public static function checkContentFile($path)
    {
        if(File::isFileExists($path))
            $content = File::getFileContents($path);
        return (!empty($content));
    }

    /**
     * @return mixed
     * @throws Exceptions\HelperException
     */
    public static function getHlUserFields()
    {
        $helper = new HlblockHelper();
        return $GLOBALS['USER_FIELD_MANAGER']->GetUserFields(
            $helper->getEntityId('Appointments'),
            0,
            LANGUAGE_ID
        );
    }

    public static function isAdmin()
    {
        global $USER;
        return $USER->IsAdmin();
    }

}