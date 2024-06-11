@extends('layouts.master')

@section('title')
Trang Chủ
@endsection

@section('content')
<div class="row">
    <?php foreach ($products as $product): ?>
    <div class="col-md-3">
        <div class="white_card position-relative mb_20">
            <div class="card-body">
                <?php if ($product['price_sale'] > 0 && $product['price_sale']): ?>
                <div class="ribbon1 rib1-primary">
                    <span class="text-white text-center rib1-primary"><?= round(($product['price_regular'] - $product['price_sale']) / $product['price_regular'] * 100) ?>% off</span>
                </div>
                <?php endif; ?>
                <a href="<?= url("products/") . $product['id'] ?>">
                    <img src="<?= asset($product['img_thumbnail']) ?>" alt class="d-block mx-auto my-4" height="200">
                </a>
                <div class="row my-2">
                    <div class="col">
                        <a class="" href="<?= url("products/") . $product['id'] ?>">
                            <span class="badge-btn-3" style="font-size: 14px;">
                                <?= $product['name'] ?>
                            </span>
                        </a>
                        <a href="#" class="f_w_400 color_text_3 f_s_12 d-block" style="font-size: 12px;"><?= $product['category_name'] ?></a>
                    </div>
                    <div class="col-auto">
                        <h4 class="text-dark mt-0">
                            <span class="text-danger font-12 fw-bold"><?= ($product['price_sale'] > 0 && $product['price_sale']) ? $product['price_sale'] : $product['price_regular'] ?> VND</span>
                            <?php if ($product['price_sale'] > 0 && $product['price_sale']): ?>
                            <small class="text-muted font-10 d-block">
                                <del><?= $product['price_regular'] ?> VND</del>
                            </small>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
                <div class="d-grid">
                    <a href="<?= url('cart/add')?>?quantity=1&productId=<?=$product['id']?>" class="btn btn-info" href="">Add To Card</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
@endsection
