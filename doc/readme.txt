介绍：
这个为yii2.0版本，使用yii-advanced-app-2.0.0-beta模板开发，现在刚刚开始，仅仅完成简单的版本、帖子、回帖功能。
前台页面：frontedn/web/
后台页面：backedn/web/

功能详情见：http://www.yiifans.com/forum.php?mod=viewthread&tid=68

讨论交流：
论坛：www.yiifans.com
qq群：308110659

开发环境、工具：
使用wamp环境、zend 10.5工具开发

程序安装：
vendor:
由于这个文件比较大，所以就没有上传这个文件。
你可以直接下载文件：https://github.com/yiisoft/yii2/releases/download/2.0.0-beta/yii-advanced-app-2.0.0-beta.tgz
解压，把里面的vendor复制到vendor目录即可。

数据库安装：
创建数据库 yiiform utf8编码，然后导入data\sql\yiiforum_20140520.sql数据脚本。
这个为初始安装脚本，剩下的都为升级脚本。然后通过前面页面右上脚点击升级。

当前，你也可以按从小到大的日期顺序依次执行，然后设置data\sql\upgrade.txt里面的日期为最后安装的sql脚本。
注：data\sql\upgrade.txt文件必须为可写。



