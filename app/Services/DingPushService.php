<?php

namespace App\Services;


use Qian\DingTalk\DingTalk;
use Qian\DingTalk\Message;

class DingPushService
{
    public static function sendText($content = ' ')
    {
        $DingTalk = new DingTalk();
        $message = new Message();
        $data = $message->text($content);
        $res = $DingTalk->send($data);

        return $res;
    }

    public static function sendLink($title = ' ', $text = ' ', $messageUrl, $picUrl = '')
    {
        $DingTalk = new DingTalk();
        $message = new Message();
        $data = $message->link($title, $text, $messageUrl, $picUrl);
        $res = $DingTalk->send($data);

        return $res;
    }

}
