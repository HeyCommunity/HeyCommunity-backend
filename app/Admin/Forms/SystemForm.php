<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class SystemForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '系统配置';

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
            'wxapp_subscribe_message_enable'                =>  'required|boolean',
            'wxapp_subscribe_message_thumb_up_temp_id'      =>  'nullable|string',
            'wxapp_subscribe_message_comment_temp_id'       =>  'nullable|string',
            'wxapp_subscribe_message_reply_temp_id'         =>  'nullable|string',
        ]);

        $this->updateEnv([
            'SYSTEM_UGC_AUDIT'  =>  $request->get('ugc_audit') ? 'true' : 'false',
            'WXAPP_SUBSCRIBE_MESSAGE_ENABLE'  =>  $request->get('wxapp_subscribe_message_enable') ? 'true' : 'false',
            'WXAPP_SUBSCRIBE_MESSAGE_THUMB_UP_TEMP_ID'  =>  $request->get('wxapp_subscribe_message_thumb_up_temp_id'),
            'WXAPP_SUBSCRIBE_MESSAGE_COMMENT_TEMP_ID'  =>  $request->get('wxapp_subscribe_message_comment_temp_id'),
            'WXAPP_SUBSCRIBE_MESSAGE_REPLY_TEMP_ID'  =>  $request->get('wxapp_subscribe_message_reply_temp_id'),
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
            ->help('用户创建的内容（动态、评价、用户资料等）是否需要后台审核')
            ->options([0 => '不审核', 1 => '需要审核'])
            ->default(1);

        $this->radioButton('wxapp_subscribe_message_enable', '微信订阅消息')
            ->options([0 => '关', 1 => '开'])->default(0)
            ->help('系统中点赞、评论、回复等通知，通过微信小程序一次性订阅消息进行发送');
        $this->text('wxapp_subscribe_message_thumb_up_temp_id', '点赞消息模板 ID');
        $this->text('wxapp_subscribe_message_comment_temp_id', '评论消息模板 ID');
        $this->text('wxapp_subscribe_message_reply_temp_id', '回复消息模板 ID');
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

            'wxapp_subscribe_message_enable'                =>  config('system.wxapp.subscribe_message.enable'),
            'wxapp_subscribe_message_thumb_up_temp_id'      =>  config('system.wxapp.subscribe_message.thumb_up_temp_id'),
            'wxapp_subscribe_message_comment_temp_id'       =>  config('system.wxapp.subscribe_message.comment_temp_id'),
            'wxapp_subscribe_message_reply_temp_id'         =>  config('system.wxapp.subscribe_message.reply_temp_id'),
        ];
    }

    /**
     * Update env
     */
    protected function updateEnv($data = array())
    {
        if (!count($data)) {
            return;
        }

        $pattern = '/([^\=]*)\=[^\n]*/';

        $envFile = base_path() . '/.env';
        $lines = file($envFile);
        $newLines = [];
        foreach ($lines as $line) {
            preg_match($pattern, $line, $matches);

            if (!count($matches)) {
                $newLines[] = $line;
                continue;
            }

            if (!key_exists(trim($matches[1]), $data)) {
                $newLines[] = $line;
                continue;
            }

            $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
            $newLines[] = $line;
        }

        $newContent = implode('', $newLines);
        file_put_contents($envFile, $newContent);
    }
}
