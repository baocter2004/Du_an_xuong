@extends('layouts.master')

@section('title')
Chi Tiết Sản Phẩm
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="white_card position-relative mb_20">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <img src="<?= url($product['img_thumbnail']) ?>" alt class="mx-auto d-block sm_w_100" height="300" />
                    </div>

                    <div class="col-lg-6 align-self-center">
                        <div class="single-pro-detail">
                            <p class="mb-1">Dastyle</p>
                            <div class="custom-border mb-3"></div>
                            <h3 class="pro-title"><?= $product['name'] ?></h3>
                            <ul class="list-inline mb-2 product-review">
                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="fas fa-star-half text-warning"></i></li>
                                <li class="list-inline-item">4.5
                                    (9830 reviews)</li>
                            </ul>
                            <h2 class="pro-price">
                                <!-- nếu có giảm giá thì gạch chân giá gốc , hiện giá thật còn không thì hiện mỗi giá thật -->
                                <?php
                                $display_sale_price = ($product['price_sale'] > 0 && $product['price_sale']) ? '<small class="text-red font-14">' . $product['price_sale'] . 'vnđ</small>' : '   ';
                                echo $display_sale_price;
                                ?>
                                <span>
                                    <del>
                                        <?= $product['price_regular'] ?> VND
                                    </del>
                                </span>
                                <span class="text-danger fw-bold ms-2">
                                    <?php
                                    if ($product['price_sale'] > 0 && $product['price_sale']) {
                                        $pricePercent = ($product['price_sale'] / $product['price_regular']) * 100;
                                        echo "<span class='text-danger fw-bold ms-2'>$pricePercent % off</span>";
                                    }
                                    ?>
                                </span>
                            </h2>
                            <h6 class="text-muted font_s_13 mt-2 mb-1">Overview: </h6>
                            <ul class="list-unstyled pro-features border-0">
                                <li>
                                    <?= $product['overview'] ?>
                                </li>
                            </ul>
                            <div class="quantity mt-3">
                                <form action="<?= url('cart/add') ?>" method="get">
                                    <input class="form-control form-control-sm" type="number" min="0" value="0" id="example-number-input" value="1" name="quantity" />
                                    <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                                    <button type="submit" class="btn green_bg text-white px-4 d-inline-block">
                                        <i class="fa fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white_card position-relative mb_20">
            <div class="card-body">
                <h5 class="mt-0">Related Products</h5>
                <p class="text-muted mb-3 font_s_14">
                    <?= $product['content'] ?>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection