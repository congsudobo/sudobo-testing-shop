<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title th:text="#{product.add}">Cập nhật sản phẩm</title>

    <link href="{{ asset('scss/product/add.scss') }}" rel="stylesheet">
    @include('common.css')
    @include('common.js')
</head>

<body id="page-top">
    @include('common.header')
    <!-- Main Content -->
    <div class="home-main">
        <!-- Begin Page Content -->
        <div class="container-fluid">
             <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="header">
                    <span class="title">Cập nhật sản phẩm</span>
                </div>
                <form action="/product/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    @component('product_detail', ['product' => $product, 'categories' => $categories])
                    @endcomponent
                    <div class="product-submit"><button class="body-submit-button">Cập nhật</button></div>
                </form>
            </div>
        </div>
         <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    @include('common.footer')
</body>
</html>