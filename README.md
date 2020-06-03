


Dcat Admin扩展 - 错误日志预览
======

这是一个`Dcat Admin`的扩展包

搬运的`https://github.com/laravel-admin-extensions/log-viewer`

之前用laravel-amdin, 安装的log-viewer，一直觉得挺方便监控错误日志的，但是用了Dcat后暂时就没有支持这个插件

现在只修改了少量代码用于支持在Dcat Admin中运行

## 安装

请先确保安装了[Dcat Admin](https://github.com/jqhph/dcat-admin)，执行
```php
composer require dcat-admin-extensions/log-viewer
```

最后用浏览器打开`http://localhost:8000/admin/helpers/extensions`找到`log-viewer`这一行，点击`启用`按钮，即可使用。

除了通过界面启用扩展，也可以手动开启扩展：打开`config/admin-extensions.php`(如果文件不存在请手动创建)，加入以下代码：
```php
return [
    'log-viewer' => [
        'enable' => true,
    ],
];
```

## 使用

以上步骤都完成之后`http://localhost:8000/admin/logs`，就可以访问了。

