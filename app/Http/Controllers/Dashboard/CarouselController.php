<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * 列表页
     */
    public function index(Request $request)
    {
        if (! in_array($request->get('type'), array_keys(Carousel::$types))) {
            return redirect()->route($request->route()->getName(), ['type' => array_key_first(Carousel::$types)]);
        }

        $carousels = Carousel::where('type', $request->get('type'))
            ->orderByRaw('ISNULL(sort), sort ASC')
            ->orderByDesc('id')
            ->paginate();

        return view('dashboard.carousels.index', compact('carousels'));
    }

    /**
     * 创建页
     */
    public function create(Carousel $carousel)
    {
        $carousel->setAttribute('type', request('type'));

        return view('dashboard.carousels.create', compact('carousel'));
    }

    /**
     * 创建处理
     */
    public function store(Request $request, Carousel $carousel)
    {
        $request->validate([
            'type'              =>  'required|string',
            'image_path'        =>  'required|image',
            'title'             =>  'required|string',
            'link'              =>  'required|string',
            'content'           =>  'nullable|string',
            'sort'              =>  'nullable|string',
            'status'            =>  'required|integer',
        ]);

        $carousel->setAttribute('type', $request->get('type'));
        $carousel->setAttribute('title', $request->get('title'));
        $carousel->setAttribute('content', $request->get('content'));
        $carousel->setAttribute('link', $request->get('link'));
        $carousel->setAttribute('sort', $request->get('sort'));
        $carousel->setAttribute('status', $request->get('status'));

        if ($request->has('image_path')) {
            $imagePath = $request->file('image_path')->store('uploads/carousels/images');
            $carousel->setAttribute('image_path', $imagePath);
        }

        if ($carousel->save()) {
            flash('创建成功')->success();
            return redirect()->route('dashboard.carousels.index', ['type' => $carousel->getAttribute('type')]);
        } else {
            flash('创建失败')->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * 编辑页
     */
    public function edit(Carousel $carousel)
    {
        return view('dashboard.carousels.edit', compact('carousel'));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'type'              =>  'required|string',
            'image_path'        =>  'nullable|image',
            'title'             =>  'required|string',
            'link'              =>  'required|string',
            'content'           =>  'nullable|string',
            'sort'              =>  'nullable|string',
            'status'            =>  'required|integer',
        ]);


        $carousel->setAttribute('type', $request->get('type'));
        $carousel->setAttribute('title', $request->get('title'));
        $carousel->setAttribute('content', $request->get('content'));
        $carousel->setAttribute('link', $request->get('link'));
        $carousel->setAttribute('sort', $request->get('sort'));
        $carousel->setAttribute('status', $request->get('status'));

        if ($request->has('image_path')) {
            $imagePath = $request->file('image_path')->store('uploads/carousels/images');
            $carousel->setAttribute('image_path', $imagePath);
        }

        if ($carousel->save()) {
            flash('更新成功')->success();
            return redirect()->route('dashboard.carousels.index', ['type' => $carousel->getAttribute('type')]);
        } else {
            flash('更新失败')->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * 删除处理
     */
    public function destroy(Carousel $carousel)
    {
        $carousel->delete();

        flash('操作成功')->success();
        return redirect()->route('dashboard.carousels.index', ['type' => $carousel->type]);
    }
}
