<?php

namespace App\Admin\Forms\System;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class UgcConfigForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '内容安全';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $this->validate($request, [
            'guc_audit'     =>  'required|boolean',
        ]);

        systemUpdateEnvironmentValue([
            'SYSTEM_UGC_AUDIT'  =>  $request->get('ugc_audit') ? 'true' : 'false',
        ]);

        admin_success('操作成功');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->radioButton('ugc_audit', 'UGC 审核')
            ->help("用户创建的内容（动态、评价、用户资料等）是否需要后台审核。<br> 当前已接入小程序内容安全 API，建议关闭此功能。")
            ->options([0 => '关闭', 1 => '开启'])
            ->default(1);
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'ugc_audit'     =>  config('system.ugc_audit'),
        ];
    }
}
