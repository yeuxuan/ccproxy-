<?php
/*
 * @Author: yihua
 * @Date: 2025-01-04 12:25:10
 * @LastEditTime: 2025-01-05 17:52:29
 * @LastEditors: yihua
 * @Description: 
 * @FilePath: \ccproxy_end\index.php
 * 💊物物而不物于物，念念而不念于念🍁
 * Copyright (c) 2025 by yihua, All Rights Reserved. 
 */
$is_defend = true;
@header('Content-Type: text/html; charset=UTF-8');
include("./includes/common.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $subconf['hostname']; ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="./assets/layui/css/layui.css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./assets/Message/css/message.css" />
    <link rel="stylesheet" type="text/css" href="./assets/layui/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/style_PC.css" media="screen and (min-width: 960px)" />
    <!-- <link rel="stylesheet" type="text/css" href="./assets/css/style_Phone.css" media="screen and (min-width: 720px)" /> -->
    <style type="text/css">
        /* 全局样式 */
        body {
            background: #f5f7fa;
            color: #333;
        }

        .layui-container {
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease-out;
        }

        /* Logo区域样式优化 */
        .layui-logo {
            padding: 30px 0;
            text-align: center;
        }

        .wz-title h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            animation: fadeInUp 0.8s ease-out;
        }

        .img img {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .img img:hover {
            transform: scale(1.05);
        }

        /* 按钮样式优化 */
        .cer {
            margin-top: 25px;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .cer .layui-btn {
            padding: 0 25px;
            height: 40px;
            line-height: 40px;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .cer .buwz {
            display: flex;
        }

        .cer .layui-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* 主面板样式 */
        .main {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-top: 20px;
        }

        /* 选项卡样式 */
        .layui-tab-title {
            border-bottom: 2px solid #f0f0f0;
        }

        .layui-tab-title li {
            padding: 0 25px;
            font-size: 15px;
            position: relative;
            overflow: hidden;
        }

        .layui-tab-title .layui-this {
            color: #009688;
        }

        .layui-tab-title .layui-this:after {
            height: 2px;
            background-color: #009688;
        }

        .layui-tab-title li:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #009688;
            transition: all 0.3s ease;
        }

        .layui-tab-title li:hover:after {
            left: 0;
            width: 100%;
        }

        /* 输入框样式 */
        .inputs {
            height: 45px;
            margin: 15px 0;
            border-radius: 5px;
            border: 1px solid #e6e6e6;
            transition: all 0.3s ease;
        }

        .inputs:focus {
            border-color: #009688;
            box-shadow: 0 0 5px rgba(0, 150, 136, 0.2);
            transform: translateY(-2px);
        }

        /* 提交按钮样式 */
        .submit {
            margin-top: 25px;
            text-align: center;
        }

        .submit .layui-btn {
            width: 200px;
            height: 45px;
            line-height: 45px;
            font-size: 15px;
            border-radius: 25px;
            background: #009688;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .submit .layui-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 150, 136, 0.2);
        }

        .submit .layui-btn:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease-out, height 0.6s ease-out;
        }

        .submit .layui-btn:active:after {
            width: 300px;
            height: 300px;
            opacity: 0;
        }

        /* 查询结果样式优化 */
        .time {
            width: 80%;
            margin: 20px auto;
        }

        .time div {
            box-sizing: border-box;
            padding: 15px;
            background-color: #f8f8f8;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out;
        }

        .time div:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .time div b {
            color: #009688;
            font-weight: 500;
        }

        /* 添加移动端选项卡样式优化 */
        @media screen and (max-width: 480px) {
            .layui-tab-title li {
                padding: 0 12px;
                /* 减小内边距 */
                font-size: 14px;
                /* 稍微减小字体 */
            }

            /* 简化选项卡文字 */
            .layui-tab-title li[data-mobile-text]:not(.layui-this) {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 360px) {
            .layui-tab-title li {
                padding: 0 8px;
                /* 更小的内边距 */
                font-size: 13px;
                /* 更小的字体 */
            }
        }

        /* 添加移动端适配 */
        @media screen and (max-width: 480px) {
            .time {
                padding: 0;
            }

            .time div {
                font-size: 13px;
                /* 移动端稍微减小字体 */
                padding: 12px;
                /* 减小内边距 */
                /* width: calc(100% - 20px);
                margin-left: 10px; */
            }
        }

        /* 添加页面加载动画 */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 选项卡切换动画 */
        .layui-tab-content .layui-tab-item {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="layui-container">
        <!-- logo部分 -->
        <div class="layui-logo">
            <div class="layui-row">
                <div class="layui-card layui-col-xs12">
                    <div class="wz-title">
                        <h1><?php echo $subconf['hostname']; ?></h1>
                    </div>
                    <div class="img">
                        <!-- <img src="<?php echo $subconf['img']; ?>" alt="logo"> -->
                        <img src="/assets/img/one-by-one.gif" lay-src="<?php echo $subconf['img']; ?>" alt="logo">
                    </div>
                    <div class="layui-col-xs-12 cer">
                        <a class="buwz" style="color:white" onclick="<?php echo $subconf['ggswitch'] == 1 ? "showgg()" : "notgg()"; ?>">
                            <div class="layui layui-btn layui-btn-danger">公告</div>
                        </a>
                        <a class="buwz" style="color:white" href="<?php echo $subconf['kf']; ?>">
                            <div class="layui layui-btn layui-btn-normal">客服</div>
                        </a>
                        <a class="buwz" style="color:white" href="<?php echo $subconf['pan']; ?>">
                            <div class="layui layui-btn layui-btn-checked">网盘</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 面板部分 -->
        <div class="main">
            <div style="margin: 0;" class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this" data-mobile-text="充值">卡密充值</li>
                    <li data-mobile-text="注册">用户注册</li>
                    <li data-mobile-text="查询">用户查询</li>
                </ul>
                <div class="layui-tab-content" style="height: auto;">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-input-block">
                            <input type="text" name="km" id="pay-user" class="layui-input inputs" placeholder="请输入充值账号" lay-verify="required" />
                        </div>
                        <div class="layui-input-block">
                            <input type="text" name="code" id="pay-code" class="layui-input inputs" placeholder="请输入充值卡密" lay-verify="required" />
                        </div>
                        <div class="layui-input-block layui-btn-xs submit">
                            <button id="pay" type="button" class="layui-btn layui-btn-normal">充值</button>
                        </div>
                    </div>
                    <!-- <div class="layui-tab-item">
                         <div class="layui-input-block">
                            <input type="text" name="code" id="post-code" class="layui-input inputs" placeholder="请输入兑换卡密" lay-verify="required" />
                        </div>
                        <div class="layui-input-block layui-btn-xs submit">
                            <button id="postpay" type="button" class="layui-btn layui-btn-normal">兑换</button>
                        </div>
                    </div> -->
                    <div class="layui-tab-item">
                        <div class="layui-input-block">
                            <input type="text" name="km" id="reg-user" class="layui-input inputs" placeholder="请输入账号" lay-verify="required" />
                        </div>
                        <div class="layui-input-block">
                            <input type="text" name="km" id="reg-pwd" class="layui-input inputs" placeholder="请输入密码" lay-verify="required" />
                        </div>
                        <div class="layui-input-block">
                            <input type="text" name="km" id="reg-code" class="layui-input inputs" placeholder="请输入卡密" lay-verify="required" />
                        </div>
                        <div class="layui-input-block layui-btn-xs submit">
                            <button id="registed" type="button" class="layui-btn layui-btn-normal">注册</button>
                        </div>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-input-block">
                            <div class="layui-form form">
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <select id="sel" name="app" lay-filter="app" lay-verify="required">
                                            <option value=""></option>
                                            <!-- <option value="0">一花端口(公端)</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-input-block">
                            <input type="text" name="km" id="check-user" class="layui-input inputs" placeholder="请输入查询账号" lay-verify="required" />
                        </div>
                        <div class="time">
                        </div>
                        <div class="layui-input-block layui-btn-xs submit">
                            <button id="check" type="button" class="layui-btn layui-btn-normal">查询</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- foot底部 -->
        <div class="layui-footer">

        </div>
    </div>
    <script src="./assets/Message/js/message.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./assets/layui/layui.js"></script>
    <script src="./assets//js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/jquery.cookie.min.js"></script>
    <script src="./assets/js/sweetalert.min.js"></script>
    <script type="text/javascript">
        // 统一的 API 处理工具
        const API = {
            async request(url, data, options = {}) {
                const defaultOptions = {
                    type: "POST",
                    dataType: "json",
                    timeout: 30000,
                    beforeSend: () => {
                        layer.msg("处理中...", {
                            icon: 16,
                            shade: 0.05,
                            time: false
                        });
                    }
                };

                try {
                    const response = await $.ajax({
                        url,
                        data,
                        ...defaultOptions,
                        ...options
                    });
                    layer.closeAll();
                    return response;
                } catch (error) {
                    layer.closeAll();
                    throw error;
                }
            }
        };

        // 表单验证工具
        const Validator = {
            username(value) {
                if (!value) return "账号不能为空";
                if (value.length < 5) return "账号长度不得小于5位";
                if (!/^[A-Za-z0-9]+$/.test(value)) return "账号只能包含数字和英文";
                return null;
            },

            password(value) {
                if (!value) return "密码不能为空";
                if (value.length < 5) return "密码长度不得小于5位";
                if (!/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{5,16}$/.test(value)) {
                    return "密码必须包含数字和字母，长度在5-16位之间";
                }
                return null;
            },

            code(value, minLength = 1) {
                if (!value) return "卡密不能为空";
                if (value.length < minLength) return `卡密长度不得小于${minLength}位`;
                if (value.length > 128) return "卡密长度最大为128位";
                return null;
            }
        };

        // 消息提示工具
        const Message = {
            success(msg) {
                layer.msg(msg, {
                    icon: 1
                });
                Qmsg.success(msg, {
                    html: true
                });
            },
            error(msg) {
                layer.msg(msg, {
                    icon: 5
                });
                Qmsg.error(msg, {
                    html: true
                });
            },
            info(msg) {
                Qmsg.info(msg);
            }
        };

        layui.use(["jquery", "form", "element", "flow"], function() {
            const {
                $,
                form,
                element,
                flow
            } = layui;
            let selectHeight = 0;

            // 初始化
            initializeApp();

            // 事件绑定
            bindEvents();

            // 初始化应用
            function initializeApp() {
                loadApplications();
                flow.lazyimg();
                checkScreenSize();

                // 初始化公告
                initializeAnnouncement();
            }

            // 加载应用列表
            async function loadApplications() {
                try {
                    const response = await API.request("api/api.php?act=gethostapp");
                    if (response.code === "1") {
                        updateApplicationSelect(response.msg);
                    }
                } catch (error) {
                    Message.error("获取应用列表失败");
                }
            }

            // 更新应用选择器
            function updateApplicationSelect(applications) {
                const $select = $("[name=app]");
                const options = applications.map(app =>
                    `<option value="${app.appcode}">${app.appname}</option>`
                ).join('');

                $select.append(options);
                form.render("select");

                handleSelectHeight();
            }

            // 处理选择器高度
            function handleSelectHeight() {
                $(".layui-form-select").on("click", function() {
                    const $layuiShow = $(".layui-show");
                    const $upbit = $(".layui-anim-upbit");
                    selectHeight = $layuiShow.outerHeight(true);

                    if ($upbit.outerHeight(true) > $layuiShow.outerHeight(true)) {
                        $layuiShow.css("height", $upbit.outerHeight(true) + 40);
                    }
                });
            }

            // 绑定事件处理
            function bindEvents() {
                // 充值按钮点击事件
                $("#pay").on("click", handlePay);

                // 注册按钮点击事件
                $("#registed").on("click", handleRegister);

                // 查询按钮点击事件
                $("#check").on("click", handleQuery);
            }

            // 充值处理
            async function handlePay() {
                const user = $("#pay-user").val();
                const code = $("#pay-code").val();

                const userError = Validator.username(user);
                if (userError) return Message.info(userError);

                const codeError = Validator.code(code);
                if (codeError) return Message.info(codeError);

                try {
                    const response = await API.request("api/cpproxy.php?type=update", {
                        user,
                        code
                    });
                    if (response.code === 1) {
                        Message.success("充值成功");
                    } else {
                        Message.error(response.msg || "充值失败");
                    }
                } catch (error) {
                    Message.error("充值失败");
                }
            }

            // 注册处理
            async function handleRegister() {
                const user = $("#reg-user").val().trim();
                const pwd = $("#reg-pwd").val().trim();
                const code = $("#reg-code").val().trim();

                // 验证输入
                const userError = Validator.username(user);
                if (userError) return Message.info(userError);

                const pwdError = Validator.password(pwd);
                if (pwdError) return Message.info(pwdError);

                const codeError = Validator.code(code, 15);
                if (codeError) return Message.info(codeError);

                try {
                    $("#registed").prop("disabled", true);
                    const response = await API.request("api/cpproxy.php?type=insert", {
                        user,
                        pwd,
                        code
                    });

                    if (response.code === 1) {
                        Message.success(response.msg);
                    } else {
                        Message.error(response.msg);
                    }
                } catch (error) {
                    Message.error("注册失败");
                } finally {
                    $("#registed").prop("disabled", false);
                }
            }

            // 查询处理
            async function handleQuery() {
                const user = $("#check-user").val();
                const appcode = $("#sel option:checked").val();

                if (!appcode) return Message.info("请选择一个应用");

                const userError = Validator.username(user);
                if (userError) return Message.info(userError);

                try {
                    const response = await API.request("api/cpproxy.php?type=query", {
                        user,
                        appcode
                    });

                    if (response.code === 1) {
                        updateQueryResult(response.msg);
                        Message.success("查询成功");
                    } else {
                        Message.error(response.msg || "查询失败");
                    }
                } catch (error) {
                    $(".time").eq(0).html("");
                    Message.error("查询失败");
                }
            }

            // 更新查询结果
            function updateQueryResult(msg) {
                $(".time").eq(0).html(`
                    <div style='padding: 10px; border: 1px solid #c3e6cb; color: #155724; font-size: 12px; line-height: 2em; background-color: #e8f8f5; margin-bottom: 10px;'>
                        <b>${msg}</b>
                    </div>
                `);
            }

            // 检查屏幕尺寸
            function checkScreenSize() {
                if (window.innerWidth <= 480) {
                    $('.layui-tab-title li').each(function() {
                        const $this = $(this);
                        const mobileText = $this.data('mobile-text');
                        if (mobileText) {
                            $this.text(mobileText);
                        }
                    });
                } else {
                    // 恢复原始文本
                    $('.layui-tab-title li').each(function() {
                        const $this = $(this);
                        const originalText = $this.hasClass('layui-this') ? '卡密充值' :
                            ($this.index() === 1 ? '用户注册' : '用户查询');
                        $this.text(originalText);
                    });
                }
            }

            // 添加窗口大小改变监听
            $(window).on('resize', checkScreenSize);

            // 初始化公告
            function initializeAnnouncement() {
                const isModal = <?php echo empty($conf['wzgg']) ? 'false' : 'true'; ?>;
                if (!$.cookie('op') && isModal) {
                    showAnnouncement();
                    setAnnouncementCookie();
                }
            }

            // 显示公告
            window.showgg = function() {
                showAnnouncement();
                setAnnouncementCookie();
            };

            // 显示无公告提示
            window.notgg = function() {
                swal({
                    title: "公告",
                    icon: "info",
                    button: "好的",
                    text: "没有公告"
                });
            };

            function showAnnouncement() {
                const content = document.createElement("div");
                content.innerHTML = '<?php echo $conf['wzgg']; ?>';
                swal({
                    title: "公告",
                    icon: "success",
                    button: "好的",
                    content: content
                });
            }

            function setAnnouncementCookie() {
                const cookieTime = new Date();
                cookieTime.setTime(cookieTime.getTime() + (10 * 60 * 1000));
                $.cookie('op', false, {
                    expires: cookieTime
                });
            }
        });
    </script>
</body>

</html>