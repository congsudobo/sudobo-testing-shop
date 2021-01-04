<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title th:text="#{product.add}">Thêm sản phẩm</title>

    <link href="{{ asset('scss/product/add.scss') }}" rel="stylesheet">
    @include('common.css')
    @include('common.js')
</head>

<body id="page-top">
    @include('common.header')
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div class="home-main">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="header">
                        <span class="title">Thêm sản phẩm</span>
                    </div>
                    <form action="/product/add" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="product-input">
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Tên sản phẩm *</label>
                                <input style="width: 85%" class="form-control form-control-user" placeholder="Nhập tên sản phẩm" type="text" name="product_name" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%"class="label-product">Số lượng</label>
                                <input style="width: 85%" class="form-control form-control-user" placeholder="Nhập số lượng sản phẩm" type="number" name="count" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Danh mục *</label>
                                <select style="width: 85%" class="form-control form-control-user" type="number" name="category_id" >
                                    <option>Lựa chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ảnh sản phầm</label>
                                <input type="file" name="product_image">
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ngày nhập *</label>
                                <input style="width: 85%" class="form-control form-control-user" placeholder="Nhập ngày" type="date" name="added_date" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ngày hết hạn *</label>
                                <input style="width: 85%" class="form-control form-control-user" placeholder="Nhập ngày" type="date" name="expiration_date" >
                            </div>
                        </div>
                        <div class="product-submit"><button class="body-submit-button">Thêm</button></div>
                    </form>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        @include('common.footer')
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

</div>
</body>
</html>
