

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="product-input">
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Tên sản phẩm *</label>
                                <input style="width: 85%" value="{{$product->product_name ?? ''}}" class="form-control form-control-user" placeholder="Nhập tên sản phẩm" type="text" name="product_name" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%"class="label-product">Số lượng</label>
                                <input style="width: 85%" value="{{$product->count ?? ''}}" class="form-control form-control-user" placeholder="Nhập số lượng sản phẩm" type="number" name="count" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Danh mục *</label>
                                <select style="width: 85%" class="form-control form-control-user" type="number" name="category_id" >
                                    <option>Lựa chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        @isset($product)
                                            <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                            @continue
                                        @endisset
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ảnh sản phầm</label>
                                <input type="file" name="product_image">
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ngày nhập *</label>
                                <input style="width: 85%" value="{{$product->added_date ?? ''}}" class="form-control form-control-user" placeholder="Nhập ngày" type="date" name="added_date" >
                            </div>
                            <div class="product-hozi">
                                <label style="width: 15%" class="label-product">Ngày hết hạn *</label>
                                <input style="width: 85%" value="{{$product->expiration_date ?? ''}}" class="form-control form-control-user" placeholder="Nhập ngày" type="date" name="expiration_date" >
                            </div>
                            @isset($product)
                            <input type="number" hidden value="{{$product->id}}" name="id">
                            @endisset
                        </div>
     

