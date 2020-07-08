<?php

namespace app\index\controller;

use app\common\model\Post;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        $page = input('param.page', 0, 'intval');
        if ($page < 1) {
            $page = 1;
        }
        $length = 10;
        $start = ($page - 1) * $length;
        $post = new Post;
        $total = $post->count();
        $list = $post->with('user')->withCache(60)->limit($start, $length)->order('create_time desc')->select();
        View::assign(compact('list', 'page', 'length', 'total'));
        return $this->label_fetch();
    }
}
