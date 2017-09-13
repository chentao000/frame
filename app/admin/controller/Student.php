<?php

namespace app\admin\controller;

use houdun\view\View;
use system\model\Student as StudentModel;

class Student extends Common
{
    public function index()
    {
        //执行关联语句获取所有需要的数据
        $data = StudentModel::query("select * from student s JOIN grade g on s.gid=g.gid join material m on s.mid = m.mid");
        //dd($data);die;
        return View::make()->with(compact('data'));
    }

    /**
     * @return mixed
     */
    public function add()
    {
        if (IS_POST) {//是够点击提交
            //调用GradeModel中的add方法传递post参数
            $res = (new StudentModel())->add($_POST);
            //dd ($res);
            //根据$res['code']的值判断是否登录成功
            if ($res['code']) {//为1时登录成功跳转到主页
                //跳转主页并成功提示
                $this->setRedirect(u('index'))->message($res['msg']);
            } else {//为0时返回上一级
                //跳转登录页面并提供登录错误原因
                $this->setRedirect()->message($res['msg']);
            }
        }
        //获取头像数据
        $materialData = $this->getMaterialData();
        //获取班级数据
        $gradeData = $this->getGradeData();
        return View::make()->with(compact( 'materialData', 'gradeData'));
    }

    public function edit()
    {
        //获取当前需要修改的主键值
        $sid = $_GET['sid'];
        if (IS_POST) {//是够点击提交
            //调用GradeModel中的add方法传递post参数
            $res = (new StudentModel())->edit($sid,$_POST);
            //dd ($res);
            //根据$res['code']的值判断是否登录成功
            if ($res['code']) {//为1时登录成功跳转到主页
                //跳转主页并成功提示
                $this->setRedirect(u('index'))->message($res['msg']);
            } else {//为0时返回上一级
                //跳转登录页面并提供登录错误原因
                $this->setRedirect()->message($res['msg']);
            }
        }
        //获取头像数据
        $materialData = $this->getMaterialData();
        //获取班级数据
        $gradeData = $this->getGradeData();
        //获取当前需要修改的主键值对应的数据
        $oldData = StudentModel::find($sid)->toArray();
        //dd($oldData);die;
        return View::make()->with(compact('materialData', 'gradeData','oldData'));
    }

    /**
     * 删除方法
     * @return $this
     */
    public function del(){
        //echo 1;die;
        //获取get参数
        $sid = $_GET['sid'];
        //执行删除数据库
        StudentModel::destory($sid);
        //返回成功提示并跳转到首页
        return $this->setRedirect(u('student.index'))->message('删除成功');
    }








    /**
     * 获取班级数据
     * @return array
     */
    private function getGradeData()
    {
        $data = \system\model\Grade::getAll();
        $data = $data ? $data->toArray() : [];

        return $data;
    }

    /**
     * 获取媒体素材数据
     * @return array
     */
    private function getMaterialData()
    {
        $data = \system\model\Material::getAll();
        $data = $data ? $data->toArray() : [];

        return $data;
    }
}