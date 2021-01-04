<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
        <link href="{{ asset('scss/home/home.scss') }}" rel="stylesheet">
        @include('common.css')
        @include('common.js')
    </head>
    <body>
        @include('common.header')
        <main class="home-main shadow">
            <div class="home-main-table-header">
                <H2>Sản phẩm</H2>
            </div>
            <div class="home-main-table-body">
                <div class="body-filter">
                    <div class="body-filter-left">
                        <div class="filter">
                            <p class="filter-label">ID sản phẩm</p>
                            <input class="filter-input" type="number" placeholder="Nhập ID sản phẩm">
                        </div>
                        <div class="filter">
                            <p class="filter-label">Ngày nhập</p>
                            <div class="filter-input-double">
                                <input class="input-date-time" type="datetime" placeholder="Từ ngày">
                                <p class="input-p">-</p>
                                <input class="input-date-time" type="datetime" placeholder="Đến ngày">
                            </div>
                        </div>
                    </div>
                    <div class="body-filter-right">
                        <div class="filter">
                            <p class="filter-label">Danh mục</p>
                            <select class="filter-input">
                                <option>Chọn danh mục</option>
                            </select>
                        </div>
                        <div class="filter">
                            <p class="filter-label">Ngày hết hạn</p>
                            <div class="filter-input-double">
                                <input class="input-date-time" type="datetime" placeholder="Từ ngày">
                                <p class="input-p">-</p>
                                <input class="input-date-time" type="datetime" placeholder="Đến ngày">
                            </div>
                        </div>
                    </div>
                    <div class="body-submit">
                        <button class="body-submit-button" text="Tìm" type="submit">Tìm</button>
                    </div>
                </div>
                <div class="body-table">
                    <div class="body-table-function">
                        <div class="table-title">
                            <h2>Danh sách sản phẩm</h2>
                        </div>
                        <div class="table-function">
                            <a href="product/add"><button class="body-submit-button">Thêm sản phẩm mới</button></a>
                        </div>
                    </div>
                    <div class="table">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Tên sản phẩm</th>
                                  <th>Số lượng</th>
                                  <th>Ngày nhập</th>
                                  <th>Ngày hết hạn</th>
                                  <th>Danh mục</th>
                                  <th>Tuỳ chọn</th>
                                </tr>
                              </thead>
                              <tbody >
                              <tr>
                              </tr>
                                <tr>
                                  <td>Trống</td>
                                  <td>Trống</td>
                                  <td>Trống</td>
                                  <td>Trống</td>
                                  <td>Trống</td>
                                  <td><button name="btnSetRole" type="button" class="btn btn-primary">Sửa</button> <button name="btnSetRole" type="button" class="btn btn-warning">Xoá</button></td>
                                </tr>
                              </tbody>
                            </table>
                            <ul id="pagination-demo" class="pagination-mg"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('common.footer')
    </body>
    <script>
        $('#pagination-demo').twbsPagination({
            totalPages: 50,
            visiblePages: 5
        });
    </script>
</html>
