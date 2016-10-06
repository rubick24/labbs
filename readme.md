# Labbs

基于laravel5.3 的论坛系统
+ 文章 主页/新增/详情页/删除/markdown形式/分页
+ 分类 分类条目/详情页
+ 用户 profile/设置（头像）/消息（及发送）
+ 评论 文章详情页/新增/删除
+ 搜索 用户/文章
+ 邮件 注册激活邮件/修改密码
+ Owner Dashboard
   - 管理用户（设为管理员/禁言）(搜索列表/分类查看)
   - 发布公告
   - 查看日志

未完成的部分:

- admin  文章管理(审核/加精/置顶及取消);
- Photo model {id,name,url} 文章中图片资源的上传使用;
- article  edit;
- side.blade.php 侧边栏组件;
- category&tag的新增;
- markdown的xss预防;
- pjax;

大概就这些了吧。。。（逃

## Installation

`# git clone https://github.com/Deadalusmask/labbs.git`

进入项目目录后 `# composer install`
`# cp .env.example .env` 

然后编辑`.env`填下配置，对了还有`app/mail.php`。。
`# php artisan migrate`

`# php artisan serve` 访问localhost:8000创建owner用户;

`# php artisan tinker`

`> App\User::find(1)->roles()->attach(1)`

。。然后就没啥了吧

假数据的话modelfactory写好了方法，比如
`> factory(App\User::class,10)->create` //创建10个测试用户


## Based On Laravel PHP framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
