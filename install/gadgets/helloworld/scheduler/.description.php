<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$arDescription = Array(
	"NAME" =>Loc::GetMessage("GD_IBEL_NAME"),
	"DESCRIPTION" =>Loc::GetMessage("GD_IBEL_DESC"),
	"ICON"	=>"",
    'GROUP' => array('ID' => 'other'),
	"AI_ONLY" => true,
);
?>
