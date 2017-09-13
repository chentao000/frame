<?php

namespace system\model;

use houdun\model\Madel;

class Material extends Madel
{
    /**
     * 添加素材方法
     * @param $data     上传的信息
     * @return array
     */
    public function add($data)
    {
        $data = current($data);
        if ($data['error']) return ['code' => 0, 'msg' => '没有上传素材'];

        //调用上传类
        $res = $this->upload();
        //dd($res);
        //判断
        if (!$res['code']) return ['code'=>0,'msg'=>$res['msg'][0]];
        //将数据重组成和表字段对应的数组
        $data =[
            'mpath'=>$res['path'],
            'mtime'=>time()
        ];
        //执行添加
        $this->insert($data);
        return ['code' => 1, 'msg' => '添加成功'];
    }


    /**
     * 上传类
     */
    public function upload()
    {
        //创建上传目录
        $dir = "uploads/".date('y/m/d');
        //如果目录存在就不重新创建
        is_dir($dir) || mkdir($dir,0777,true);
        $storage = new \Upload\Storage\FileSystem($dir);
        $file = new \Upload\File('mpath', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
//            new \Upload\Validation\Mimetype(['image/png', 'image/gif', 'image/jpeg', 'image/gif']),
            new \Upload\Validation\Size('5M')
        ));
        $data = array(
            'name' => $file->getNameWithExtension()
        );
        try {
            $file->upload();
            return ['code'=>1,'msg'=>'','path'=>$dir."/".$data['name']];
        } catch (\Exception $e) {
            $errors = $file->getErrors();
            return ['code'=>0,'msg'=>$errors];
        }
    }
}