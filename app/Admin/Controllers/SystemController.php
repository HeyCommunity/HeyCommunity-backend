<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\System\AboutForm;
use App\Admin\Forms\System\MarqueeForm;
use App\Admin\Forms\System\WechatSubscribeNoticeConfigForm;
use App\Admin\Forms\System\UgcConfigForm;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;

class SystemController extends Controller
{
    public function index(Content $content)
    {
        return $content->title('系统配置')->description('System Configs')
            ->body(Tab::forms([
                'marquee'                   =>  MarqueeForm::class,
                'about'                     =>  AboutForm::class,
                'ugc_security'              =>  UgcConfigForm::class,
                'wechat_subscribe_notice'   =>  WechatSubscribeNoticeConfigForm::class,
            ]));
    }
}
