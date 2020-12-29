<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $__env->yieldContent('title'); ?></title>
    <link href="/Quanlytruonghoc/resources/css/footer.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/header.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/menu.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

    <link href="/Quanlytruonghoc/resources/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

        h1 {
            margin-top: 100px;
            text-align: center;
            font-size: 60px;
            line-height: 70px;
            font-family: 'roboto', sans-serif;
        }

        #container {
            margin: 0 auto;
            max-width: 890px;
        }

        p {
            text-align: center;
        }

        .toggle,
        [id^=drop] {
            display: none;
        }

        nav {
            margin: 0;
            padding: 0;
            background-color: #17568C;
        }

        #logo {
            display: block;
            padding: 0 30px;
            float: left;
            font-size: 20px;
            line-height: 60px;
        }

        nav:after {
            content: "";
            display: table;
            clear: both;
        }

        nav ul {
            float: left;
            padding: 0;
            margin: 0;
            list-style: none;
            position: relative;
        }

        nav ul li {
            margin: 0px;
            display: inline-block;
            
            background-color: #17568C;
        }

        nav a {
            display: block;
            padding: 0 20px;
            color: #FFF;
            font-size: 20px;
            line-height: 60px;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: none;
        }

        nav ul li ul li:hover {
            background: rgba(255, 255, 255, 0.582);
            ;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.582);
            ;
        }

        nav ul ul {
            display: none;
            position: absolute;
            top: 60px;
        }

        nav ul li:hover>ul {
            display: inherit;
        }

        nav ul ul li {
            width: 170px;
            float: none;
            display: list-item;
            position: relative;
        }

        nav ul ul ul li {
            position: relative;
            top: -60px;
            left: 170px;
        }

        li>a:after {
            content: ' +';
        }

        li>a:only-child:after {
            content: '';
        }


        /* Media Queries
  --------------------------------------------- */

        @media  all and (max-width: 768px) {
            #logo {
                display: block;
                padding: 0;
                width: 100%;
                text-align: center;
                float: none;
            }

            nav {
                margin: 0;
            }

            .toggle+a,
            .menu {
                display: none;
            }

            .toggle {
                display: block;
                background-color: #254441;
                padding: 0 20px;
                color: #FFF;
                font-size: 22px;
                font-weight: bold;
                line-height: 60px;
                text-decoration: none;
                border: none;
            }

            .toggle:hover {
                background-color: rgba(255, 255, 255, 0.582);
                ;
            }

            [id^=drop]:checked+ul {
                display: block;
            }

            nav ul li {
                display: block;
                width: 100%;
            }

            nav ul ul .toggle,
            nav ul ul a {
                padding: 0 40px;
            }

            nav ul ul ul a {
                padding: 0 80px;
            }

            nav a:hover,
            nav ul ul ul a {
                background-color: rgba(255, 255, 255, 0.582);
                ;
            }

            nav ul li ul li .toggle,
            nav ul ul a {
                background-color: rgba(255, 255, 255, 0.582);
                ;
            }

            nav ul ul {
                float: none;
                position: static;
                color: #ffffff;
            }

            nav ul ul li:hover>ul,
            nav ul li:hover>ul {
                display: none;
            }

            nav ul ul li {
                display: block;
                width: 100%;
            }

            nav ul ul ul li {
                position: static;
            }
        }

        @media  all and (max-width: 330px) {
            nav ul li {
                display: block;
                width: 94%;
            }
        }
    </style>
</head>
<header>
    <div class="header">
        <div class="logo">
            <a href="<?php echo e(url('/')); ?>" class="logo"><img src="/Quanlysinhvien/logo.png" id="icon" alt="User Icon" /></a>
        </div>
        <div style="float: right;" class="hello">
            <?php if(Route::has('login')): ?>
            <div class="navbar navbar-expand-lg navbar-light">
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/profile')); ?>">Xin chào <?php echo e(Auth::user()->name); ?></a>|
                <a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">Login</a>

                <?php if(Route::has('register')): ?>
                <a href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<body>
    <nav style="padding-left: 9%;">
        <label for="drop" class="toggle">&#8801; Menu</label>
        <input type="checkbox" id="drop" />
        <ul class="menu">
            <li><a href="<?php echo e(url('/')); ?>">Trang chủ</a></li>
            <?php if(Route::has('login')): ?>
            <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->level==3): ?>
            <li><a href="<?php echo e(url('/profile')); ?>">Hồ sơ</a></li>
            <li><a href="<?php echo e(url('/thoikhoabieu')); ?>">Đăng ký môn học</a></li>
            <li><a href="<?php echo e(url('/diemhoctap')); ?>">Điểm</a></li>
            <li><a href="<?php echo e(url('/xephang')); ?>">Xếp hạng</a></li>
            <li><a href="<?php echo e(url('/danhgia')); ?>">Đánh giá giảng viên</a></li>
            <?php endif; ?>
            <?php if( Auth::user()->level==2): ?>
            <li><a href="<?php echo e(url('danhsachlop')); ?>">Lớp dạy</a></li>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <li><a href="<?php echo e(url('/lienhe')); ?>">Liên hệ</a></li>
        </ul>
    </nav>
    <br />
    <div class="contai">
        <?php $__env->startSection('content'); ?>
        <?php echo $__env->yieldSection(); ?>
    </div>
</body>
    </br/>
<footer>
<div class="text-center text-light p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright:
    <a class="text-light" href="http://fitel.hnue.edu.vn/"><b>thaitc@hnue.edu.vn</b></a>
</div>
</footer>
</html><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/welcome.blade.php ENDPATH**/ ?>