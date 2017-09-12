<?php

namespace system\model;

use houdun\model\Madel;

class  Grade extends Madel
{
    /**
     * 添加方法
     * @param $data post数据
     */
    public function add($data){
        //dd($data);die();
        //数据验证
        //return ['code'=>0,'msg'=>'请输入用户名']
        //code 标识成功还是失败的标识 1代表成功，0代表失败
        //msg 提示消息
        //判断用户名是否为空
        //如果不匹配返回'code'=>0,'msg'=>'请输入班级名'
        if (!trim ($data['gname'])) return ['code'=>0,'msg'=>'请输入班级名'];

        //获取数据库数据
        //根据gname查找
        $gradeDate = $this->where("gname = '{$data['gname']}'")->getAll();
        if ($gradeDate) return ['code'=>0,'msg'=>'班级已存在'];

        //执行添加
        $this->insert($data);
        return ['code'=>1,'msg'=>'添加成功'];
    }

    /**
     * 修改方法
     * @param $gid  get参数获取的主键
     * @param $data 需要修改的post参数
     * @return array
     */
    public function edit($gid,$data){
        //判断用户名是否为空
        //如果不匹配返回'code'=>0,'msg'=>'请输入用户名
        if (!trim ($data['gname'])) return ['code'=>0,'msg'=>'请输入班级名'];

        //获取数据库数据
        //根据gname查找
        $gradeDate = $this->where("gname = '{$data['gname']}' and gid != $gid")->getAll();
        if ($gradeDate) return ['code'=>0,'msg'=>'班级已存在'];
        //dd($data);die;
        $res = $this->where("gid = {$gid}")->update($data);
        //dd($res);
        if ($res){//如果$res返回的数值不是0那么说明修改成功
            return ['code'=>1,'msg'=>'修改成功'];
        }else{//如果$res返回的数值是0那么说明数据相同
            return ['code'=>0,'msg'=>'数据未更新'];
        }

    }
}