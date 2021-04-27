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
        ]);

        $this->updateEnv([
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
            ->help('用户创建的内容（动态、评价、用户资料等）是否需要后台审核')
            ->options([0 => '不审核', 1 => '需要审核'])
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
