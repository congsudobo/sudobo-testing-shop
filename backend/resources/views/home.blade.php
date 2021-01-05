<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quản lý sản phẩm</title>
        <link href="{{ asset('scss/home/home.scss') }}" rel="stylesheet">
        @include('common.css')
        @include('common.js')
    </head>
    <body>
        @include('common.header')
        @isset($is_completed)
        @if($is_completed == 1)
            <div class="alert alert-success" role="alert">
                Thành công!
            </div>
        @else
        <div class="alert alert-danger" role="alert">
            Có lỗi xảy ra!
          </div>
        @endif
        @endisset
        <main class="home-main shadow">
            <div class="home-main-table-header">
                <H2>Sản phẩm</H2>
            </div>
            <div class="home-main-table-body">
                <div class="body-filter">
                    <form action="/" method="GET">
                        @csrf
                        <div class="body-filter-left">
                            <div class="filter">
                                <p class="filter-label">ID sản phẩm</p>
                                <input value="{{$filter['id'] ?? ''}}" name="id" class="filter-input" type="number" placeholder="Nhập ID sản phẩm">
                            </div>
                            <div class="filter">
                                <p class="filter-label">Ngày nhập</p>
                                <div class="filter-input-double">
                                    <input value="{{$filter['added_date_start'] ?? ''}}" name="added_date_start" class="input-date-time" type="date" placeholder="Từ ngày">
                                    <p class="input-p">-</p>
                                    <input value="{{$filter['added_date_end'] ?? ''}}" name="added_date_end" class="input-date-time" type="date" placeholder="Đến ngày">
                                </div>
                            </div>
                        </div>
                        <div class="body-filter-right">
                            <div class="filter">
                                <p class="filter-label">Danh mục</p>
                                <select class="filter-input" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        @isset($filter['category_id'])
                                            <option {{$category->id == $filter['category_id'] ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                            @continue
                                        @endisset
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter">
                                <p class="filter-label">Ngày hết hạn</p>
                                <div class="filter-input-double">
                                    <input value="{{$filter['expiration_date_start'] ?? ''}}" name="expiration_date_start" class="input-date-time" type="date" placeholder="Từ ngày">
                                    <p class="input-p">-</p>
                                    <input value="{{$filter['expiration_date_end'] ?? ''}}"  name="expiration_date_end" class="input-date-time" type="date" placeholder="Đến ngày">
                                </div>
                            </div>
                        </div>
                    <div class="body-submit">
                        <button class="body-submit-button" text="Tìm" type="submit">Tìm</button>
                    </div>
                    </form>
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
                              <tbody class="tbody-table">
                                @foreach ($products as $product)
                                <tr>
                                  <td>{{ $product->product_name }}
                                    <div class="product-image">
                                        @isset($product->product_image)
                                            <img src="{{asset('storage/' . $product->product_image)}}"/>
                                        @endisset
                                    </div>
                                  </td>
                                  <td>{{ $product->count }}</td>
                                  <td>{{date("m-d-Y", strtotime($product->added_date))}}</td>
                                  <td>{{date("m-d-Y", strtotime($product->expiration_date))}}</td>
                                  <td>{{$product->category->category_name}}</td>
                                  <td>
                                      <a href="product/update?id={{$product->id}}"><button name="btnUpdate" type="button" class="body-submit-button">Sửa</button></a>
                                      <a onclick="myFunction()" href="product/delete?id={{$product->id}}"><button name="btnDelete" type="button" class="body-submit-button">Xoá</button>
                                </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{ $paginator->appends($filter)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            function myFunction() {
              if(!confirm("Bạn có chắc muốn xoá nó ?")) {
                event.preventDefault()
              }
            }
            </script>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
        @include('common.footer')
    </body>
</html>
