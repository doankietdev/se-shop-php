<?php require_once "inc/components/header.php"; ?>
<?php
if (!Auth::isLoggedIn() || !isset($_SESSION['userId']))
    Auth::requireLogin();

if (!isset($conn))
    $conn = require_once "inc/db.php";

$allCartProducts = Cart::getAllProductFromCart($conn, $_SESSION['userId'])['data'];
?>
<div id="main-content" class="main-content">
    <div id="shopping-cart">
        <div class="container">
            <div class="row">
                <h1 class="shopping-cart__title mb-4">Shopping Cart</h1>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-5">
                            <span class="cart-header">Item</span>
                        </div>
                        <div class="col-2">
                            <span class="cart-header">Price</span>
                        </div>
                        <div class="col-2">
                            <span class="cart-header">Quantity</span>
                        </div>
                        <div class="col-2">
                            <span class="cart-header">Subtotal</span>
                        </div>
                        <div class="col-1">
                            <span class="cart-header"></span>
                        </div>
                    </div>
                    <?php foreach ($allCartProducts as $product) : ?>
                        <div class="cart-item" data-index="<?php echo $product->productId; ?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="border-2 border-bottom border-black border-opacity-25 my-3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <div class="cart-item-container d-flex align-items-center">
                                        <img class="cart-item__img" src="<?php echo $product->imageUrl; ?>" alt="item" />
                                        <p class="cart-item__desc m-0">
                                            <?php echo $product->name; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <span class="cart-item__price">$
                                        <span class="cart-item__price__detail"><?php echo $product->price; ?></span>
                                    </span>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <input type="number" name="quantity" min="1" value="<?php echo $product->quantity; ?>" class="cart-item__input-quantity" />
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <span class="cart-item__price cart-item-subtotal">$
                                        <span class="cart-item__subtotal__value"><?php echo $product->price * $product->quantity; ?></span>
                                    </span>
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-start">
                                    <button type="button" class="cart-item__btn-delete-cart">
                                        <i class="fa-regular fa-trash-can p-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="cart-item-control">
                        <div class="row">
                            <div class="col-12">
                                <div class="border-2 border-bottom border-black border-opacity-25 my-3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between">
                                <button class="continue-shopping">Continue Shopping</button>
                                <button <?php if (empty($allCartProducts)) : ?> disabled class="d-none" <?php else : ?> class="clear-cart" <?php endif; ?>>
                                    Clear Shopping Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($allCartProducts)) : ?>
                    <div class="col-3">
                        <div class="checkout-summary">
                            <h3 class="checkout-summary__header">Summary</h3>
                            <div class="checkout-summary__block d-flex justify-content-between my-2">
                                <p class="checkout-summary__title m-0">Subtotal</p>
                                <span class="checkout-summary__value">$
                                    <span class="checkout-summary__total"></span>
                                </span>
                            </div>
                            <div class="checkout-summary__block d-flex justify-content-between my-2">
                                <p class="checkout-summary__title m-0">Tax</p>
                                <span class="checkout-summary__value">Free</span>
                            </div>
                            <div class="checkout-summary__block d-flex justify-content-between my-2">
                                <p class="checkout-summary__title m-0">GST</p>
                                <span class="checkout-summary__value">Free</span>
                            </div>
                            <div class="checkout-summary__block d-flex justify-content-between my-2">
                                <p class="checkout-summary__title m-0">Order Total</p>
                                <span class="checkout-summary__value">$
                                    <span class="checkout-summary__total"></span>
                                </span>
                            </div>
                            <button class="checkout-summary__btn-process my-4">Proceed to Checkout</button>
                            <div class="checkout-summary__zip">
                                <img src="assets/img/zip.svg" alt="zip" class="checkout-summary__zip__img object-fit-contain" />
                                <img src="assets/img/vector.svg" alt="vector" class="checkout-summary__vector object-fit-contain" />
                                <p class="checkout-summary__zip__content m-0">up to 6 months interest free.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "inc/components/footer.php"; ?>
<script src="<?php echo APP_URL; ?>/js/header/dropdown.js"></script>
<script src="<?php echo APP_URL; ?>/js/header/searchbar.js"></script>
<script>
    // onChange
    // get the value from input field
    // calculate total value => inner html
    // bind the productId
    // get ProductId from element
    $(document).ready(function() {
        const cartQuantity = $('.cart-item__input-quantity');
        const totalPrice = $(".checkout-summary__total");

        function handleTotalPrice() {
            setInterval(function() {
                const sum = $(".cart-item__subtotal__value").get().reduce((acc, el) => acc + parseFloat(el.textContent), 0);
                totalPrice.html(sum);
            }, 500);
        }

        handleTotalPrice();

        cartQuantity.change(async function() {
            // find the closest element that this action happen
            const el = $(this).closest(".cart-item");
            // get the productId from input field
            const productQuantity = parseInt(this.value);
            // get productId from data-index
            const productId = parseInt(el.data('index'));
            // find product price
            const productPrice = parseInt(el.find(".cart-item__price__detail").html());

            console.log(productId, productQuantity);

            // update product price
            el.find(".cart-item__subtotal__value").html(productPrice * productQuantity);

            try {
                const updateCart = await $.ajax({
                    method: "POST",
                    url: "update-cart.php",
                    data: {
                        productId,
                        productQuantity
                    }
                })

                const updateInfo = JSON.parse(updateCart);
                if (updateInfo.status) {
                    toastr.success(updateInfo.message, "Update Cart");
                } else {
                    toastr.warning(updateInfo.message, "Warning");
                }
            } catch (error) {
                toastr.error("Some errors happen in cart", "Error");
            }
        })


        $(".cart-item__btn-delete-cart").click(async function() {
            // find the closest element that this action happen
            const el = $(this).closest(".cart-item");
            // get the productId from input field
            const productId = parseInt(el.data('index'));

            try {
                const deleteCart = await $.ajax({
                    method: "POST",
                    url: "delete-cart.php",
                    data: {
                        action: "<?php echo DELETE; ?>",
                        productId
                    }
                })

                const deleteInfo = JSON.parse(deleteCart);
                if (deleteInfo.status) {
                    toastr.success(deleteInfo.message, "Delete Cart");
                    el.remove();
                } else {
                    toastr.warning(deleteInfo.message, "Warning");
                }
            } catch (error) {
                toastr.error(error, "Error");
            }
        })

        $(".clear-cart").click(async function() {

            try {
                const clearCart = await $.ajax({
                    method: "POST",
                    url: "delete-cart.php",
                    data: {
                        action: "<?php echo DELETE_ALL; ?>"
                    }
                })

                const clearInfo = JSON.parse(clearCart);
                if (clearInfo.status) {
                    toastr.success(clearInfo.message, "Clear Cart");
                    $(".cart-item").remove();
                    $(".clear-cart").remove();
                    $(".checkout-summary").remove();
                    // location.reload();
                } else {
                    toastr.warning(clearInfo.message, "Warning");
                }
            } catch (error) {
                toastr.error(error, "Error");
            }
        })
    })
</script>