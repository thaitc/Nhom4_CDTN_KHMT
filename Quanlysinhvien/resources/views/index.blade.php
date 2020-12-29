@extends('welcome')
@section('title','Trang chủ')
@section('content')
<link rel="stylesheet" type="text/css" href="Quanlysinhvien/resources/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        z-index: 1;
        background-color: #f5f5f5;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .list-product-title {
        width: 100%;
        text-transform: uppercase;
        margin-left: 5px;
        margin-right: 5px;
    }

    .list-product-subtitle {
        width: 100%;
        margin-left: 5px;
        margin-right: 5px;
    }

    .card-product {
        width: 100%;
        margin-left: 5px;
        margin-right: 5px;
        overflow: hidden;
    }
</style>
<div id="carouselExampleIndicators" class="carousel slide mt-1" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="/Quanlysinhvien/img/hnue.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/Quanlysinhvien/img/hnue4.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/Quanlysinhvien/img/hnue1.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container">
    <div class="row mt-5">
        <h2 class="list-product-title">Tin tức</h2>
        <div class="list-product-subtitle">
            <p>Bài viết mới</p>
        </div>
        <div class="product-group">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="card card-product mb-3">
                        <img class="card-img-top" src="/Quanlysinhvien/img/bai1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Thông báo kết quả thi tiếng Anh</a></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Đi</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="card card-product mb-3">
                        <img class="card-img-top" src="/Quanlysinhvien/img/vn.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Thực tế K67 ở Tây Bắc</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Đi</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="card card-product mb-3">
                        <img class="card-img-top" src="/Quanlysinhvien/img/bai3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a>K67 chụp kỉ yếu</a></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Đi</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="card card-product mb-3">
                        <img class="card-img-top" src="/Quanlysinhvien/img/mn.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Khoa giáo dục mầm non</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Đi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection