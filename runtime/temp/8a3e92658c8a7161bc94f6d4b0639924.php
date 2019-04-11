<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"/var/www/html/MyBlog/public/../application/admin/view/index/main.html";i:1553046519;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>config('admin.title')</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Welcome</h5>
                </div>
                <div class="ibox-content">
                    <h2>管理后台<br/></h2>
                    <p>欢迎使用管理后台。由 THINKING 设计</p>
                    <p>项目地址: 码云地址 <a href="https://gitee.com/lovephp/thinkphp51_backstage.git" target="_blank">https://gitee.com/lovephp/thinkphp51_backstage.git</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>基本信息</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    运行环境
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">

                                            <tr>
                                                <th>PHP 版本</th>
                                                <td><?php echo PHP_VERSION; ?></td>
                                            </tr>
                                            <tr>
                                                <th>MYSQL 版本</th>
                                                <td><?php echo mysqli_get_client_version(); ?></td>
                                            </tr>
                                            <tr>
                                                <th>WEB 服务器</th>
                                                <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>操作系统</th>
                                                <td><?php echo PHP_OS; ?></td>
                                            </tr>
                                            <tr>
                                                <td>opcache (建议开启)</td>
                                                <?php if(function_exists('opcache_get_configuration')): ?>
                                                <td><?php echo opcache_get_configuration()['directives']['opcache.enable'] ? '开启' : '关闭'; ?></td>
                                                <?php else: ?>
                                                <td>未开启</td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <td>脚本最大执行时间(s)</td>
                                                <td><?php echo get_cfg_var("max_execution_time"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>上传限制大小(M)</td>
                                                <td><?php echo get_cfg_var ("upload_max_filesize"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>当前时间</td>
                                                <td><?php echo date("Y-m-d H:i:s"); ?></td>
                                            </tr>
                                            <tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">更新日志</div>
                                <div class="panel-body">
                                    <div class="ibox-content timeline">
                                        <div class="timeline-item">
                                            <div class="row">
                                                <div class="col-xs-3 date">
                                                    <i class="fa fa-briefcase"></i> 6:00
                                                    <br>
                                                    <small class="text-navy">2018-11-16</small>
                                                </div>
                                                <div class="col-xs-7 content no-top-border">
                                                    <p class="m-b-xs"><strong>后台框架搭建</strong></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3 date">
                                                    <i class="fa fa-briefcase"></i> 6:00
                                                    <br>
                                                    <small class="text-navy">2018-12-11</small>
                                                </div>
                                                <div class="col-xs-7 content no-top-border">
                                                    <p class="m-b-xs"><strong>后台修复bug</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<!-- 自定义js -->
<script src="/static/admin/js/content.js?v=1.0.0"></script>

</body>

</html>
