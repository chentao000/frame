<?php
namespace system\model;
use houdun\model\Madel;

class Student extends Madel
{

    /**
     * 添加方法
     * @param $data post数据
     * @return array
     */
    public function add($data)
    {
        //dd($data);die;
        //数据验证
        //验证姓名不能为空
        if (!trim($data['sname'])) return ['code'=>0,'msg'=>'请输入姓名'];
        //验证年龄不能为空
        if (!trim($data['sage'])) return ['code'=>0,'msg'=>'请输入年龄'];
        //验证性别不能为空
        if (!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择性别'];
        //验证头像不能为空
        if (!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择头像'];
        //验证班级不能为空
        if (!$data['gid']) return ['code'=>0,'msg'=>'请选择班级'];

        $this->insert($data);
        return ['code'=>1,'msg'=>'添加成功'];
    }
    public function edit($sid,$data)
    {
        //dd($data);die;
        //数据验证
        //验证姓名不能为空
        if (!trim($data['sname'])) return ['code'=>0,'msg'=>'请输入姓名'];
        //验证年龄不能为空
        if (!trim($data['sage'])) return ['code'=>0,'msg'=>'请输入年龄'];
        //验证性别不能为空
        if (!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择性别'];
        //验证头像不能为空
        if (!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择头像'];
        //验证班级不能为空
        if (!$data['gid']) return ['code'=>0,'msg'=>'请选择班级'];

        $this->where("sid = {$sid}")->update($data);
        return ['code'=>1,'msg'=>'修改成功'];
    }

}