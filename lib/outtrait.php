<?php

namespace HelloWorld\Scheduler;

trait OutTrait
{

    protected function out($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'out'], func_get_args());
    }

    protected function outIf($cond, $msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outIf'], func_get_args());
    }

    protected function outProgress($msg, $val, $total)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outProgress'], func_get_args());
    }

    protected function outNotice($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outNotice'], func_get_args());
    }

    protected function outNoticeIf($cond, $msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outNoticeIf'], func_get_args());
    }

    protected function outInfo($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outInfo'], func_get_args());
    }

    protected function outInfoIf($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outInfoIf'], func_get_args());
    }

    protected function outSuccess($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outSuccess'], func_get_args());
    }

    protected function outSuccessIf($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outSuccessIf'], func_get_args());
    }

    protected function outWarning($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outWarning'], func_get_args());
    }

    protected function outWarningIf($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outWarningIf'], func_get_args());
    }

    protected function outError($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outError'], func_get_args());
    }

    protected function outErrorIf($msg, ...$vars)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outErrorIf'], func_get_args());
    }

    protected function outDiff($arr1, $arr2)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outDiff'], func_get_args());
    }

    protected function outDiffIf($cond, $arr1, $arr2)
    {
        call_user_func_array(['HelloWorld\Scheduler\Out', 'outDiffIf'], func_get_args());
    }

}
