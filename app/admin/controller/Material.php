<?php

namespace app\admin\controller;

use houdun\core\Controller;
use houdun\view\View;
use system\model\Material as MaterialModel;

class Material extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        //获取数据库的所有数据
        $data = MaterialModel::order('mid');
        //如果数据库没有数据就返回一个空数组
        //如果有数据就为对象转化为数组
        //dd($data);die;
        return View::make()->with(compact( 'data'));
    }

    /**
     * @return mixed
     * 添加
     */
    public function add()
    {
        if (IS_POST) {//是够点击提交
            //调用GradeModel中的add方法传递post参数
            $res = (new MaterialModel())->add($_FILES);
            //dd ($res);
            //根据$res['code']的值判断是否登录成功
            if ($res['code']) {//为1时登录成功跳转到主页
                //跳转主页并成功提示
                $this->setRedirect(u('material.index'))->message($res['msg']);
            } else {//为0时返回上一级
                //跳转登录页面并提供登录错误原因
                $this->setRedirect()->message($res['msg']);
            }
        }
        return View::make();
    }

    /**
     * 删除
     */
    public function del()
    {
        //获取素材表主键
        $mid = $_GET['mid'];
        $data = MaterialModel::find($mid)->toArray();
        if (file_exists($data['mpath'])){
            unlink($data['mpath']);
        }
        //删除数据表数据
        MaterialModel::destory($mid);
        $this->setRedirect(u('index'))->message('删除成功');
    }
}