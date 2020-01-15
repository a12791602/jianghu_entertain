<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Fluent;

/**
 * Class UploadService
 * @package App\Services
 */
class UploadService
{

    /**
     * 储存返回结果
     * @var array $result
     */
    protected $result = [
                         'status' => false,
                         'msg'    => '上传失败!',
                         'file'   => [
                                      'name' => null,
                                      'path' => null,
                                      'size' => null,
                                     ],
                        ];

    /**
     * 表单中文件键的名称
     * @var string $inputName
     */
    protected $inputName;

    /**
     * 存储文件的磁盘
     * @var string $disk
     */
    protected $disk;

    /**
     * @var object $request
     */
    protected $request;

    /**
     * 储存路径
     * @var string $savePath;
     */
    protected $savePath;

    /**
     * UploadService constructor.
     */
    public function __construct()
    {
        $config          = config('upload');
        $config          = new Fluent($config);
        $this->request   = app('request');
        $this->inputName = $config->get('input_name', 'file');
        $this->disk      = $config->get('disk', \config('filesystems.default'));
        $this->savePath  = $this->request->path();
    }

    /**
     * @return UploadService
     */
    public function upload(): UploadService
    {
        $file = $this->getFile();
        //拼接路径
        $path = 'uploads/' . $this->savePath . '/' . date('Y-m-d') . '/' . $this->getFilename();
        //读取文件流
        $stream = fopen($file->getRealPath(), 'r');
        //开始上传
        $result = Storage::disk($this->disk)->put($path, $stream);
        //关闭资源
        if (is_resource($stream)) {
            fclose($stream);
        }
        if ($result) {
            $this->result['status']       = true;
            $this->result['msg']          = '上传成功!';
            $this->result['file']['name'] = $this->getFilename();
            $this->result['file']['path'] = $path;
            $this->result['file']['size'] = round($this->getFile()->getSize() / 1000) . 'kb';
        }
        return $this;
    }

    /**
     * @return string
     */
    protected function getFilename(): string
    {
        $path     = $this->getFile()->getRealPath();
        $exten    = $this->getFile()->getClientOriginalExtension();
        $fileName = md5_file($path) . '.' . $exten;
        return $fileName;
    }

    /**
     * @return mixed[]
     */
    public function getFileInfo(): array
    {
        return $this->result;
    }

    /**
     * @return object
     */
    protected function getFile(): object
    {
        $file = $this->request->file($this->inputName);
        return $file;
    }

    /**
     * @return string
     */
    public function getInputName(): string
    {
        return $this->inputName;
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    /**
     * @return string
     */
    public function getSavePath(): string
    {
        return $this->savePath;
    }

    /**
     * 表单中的键值
     * @param string $inputName InputName.
     * @return UploadService
     */
    public function setInputName(string $inputName): UploadService
    {
        $this->inputName = $inputName;
        return $this;
    }

    /**
     * 设置储存磁盘
     * @param string $disk Disk.
     * @return UploadService
     */
    public function setDisk(string $disk): UploadService
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * 设置储存路径
     * @param string $savePath SavePath.
     * @return UploadService
     */
    public function setSavePath(string $savePath): UploadService
    {
        $savePath       = str_replace('\\', '/', $savePath);
        $this->savePath = trim($savePath, '/');
        return $this;
    }
}
