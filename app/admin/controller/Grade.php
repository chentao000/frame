<?php

namespace app\admin\controller;

use houdun\view\View;
use system\model\Grade as GradeModel;

class Grade extends Common
{
    public function index()
    {
        //获取数据库数据
        $data= GradeModel::order('gid');
        //如果数据库为空返回一个空数组
        //如果不为空那么将对象转化为数组
        //dd($data);
        return View::make()->with(compact('data'));
    }

    public function add()
    {
        if (IS_POST){//是够点击提交
            //调用GradeModel中的add方法传递post参数
            $res=(new GradeModel())->add($_POST);
            //dd ($res);
            //根据$res['code']的值判断是否登录成功
            if ($res['code']){//为1时登录成功跳转到主页
                //跳转主页并成功提示
                $this->setRedirect (u ('grade.index'))->message ($res['msg']);
            }else{//为0时返回上一级
                //跳转登录页面并提供登录错误原因
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }

    /**
     * 修改方法
     * @return mixed
     */
    public function edit()
    {
        //获取id
        $gid = $_GET['gid'];
        if (IS_POST){
            $res=(new GradeModel())->edit($gid,$_POST);
            //dd ($res);
            //根据$res['code']的值判断是否登录成功
            if ($res['code']){//为1时登录成功跳转到主页
                //跳转主页并成功提示
                $this->setRedirect (u ('grade.index'))->message ($res['msg']);
            }else{//为0时返回上一级
                //跳转登录页面并提供登录错误原因
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        //提取数据库数据
        //在页面循环显示出来
        $oldData = GradeModel::find($gid)->toArray();
        return View::make()->with(compact('oldData'));
    }

    /**
     * 删除方法
     */
    public function del()
    {
        //获取gid的值
        $gid = $_GET['gid'];
        //执行删除
        GradeModel::destory($gid);
        //成功提示并返回主页面
        $this->setRedirect (u('index'))->message ('删除成功');
    }
}