<?php
$shop = [
    [
        'category' => 'Accessories & Peripherals',
        'sub-cat' => [
            [
                'name' => 'Keyboards',
                'id' => 'keyboard'
            ],
            [
                'name' => 'Mice',
                'id' => 'mice'
            ]
        ],
        'id' => 'accessories-and-peripherals'
    ],
    [
        'category' => 'Components',
        'sub-cat' => [
            [
                'name' => 'GPU',
                'id' => 'gpu'
            ],
            [
                'name' => 'CPU',
                'id' => 'cpu'
            ],
            [
                'name' => 'RAM',
                'id' => 'ram'
            ]
        ],
        'id' => 'components'
    ],
    [
        'category' => 'Pre-Built PC',
        'id' => 'prebuilt'
    ]
];

?>



<div class="header">
    <div class="logo" onclick="handleLogo()">
        <h3>logo</h3>
    </div>

    <div class="about-container" onclick="handleAbout()">
        <div class="about button-header">
            <h3>About</h3>
        </div>

    </div>

    <div class="shop-container">
        <div class="shop button-header" id="shop" onclick="handleShop()">

            <h3>Shop </h3>
            <img src="../../img/icons/arrow-down.svg" alt="">

        </div>

        <div class="shop-dropdown" id="shop-dropdown">

            <?php foreach ($shop as $shopCat): ?>
                <div class="container-category">
                    <div
                        class="shop-dropdown-category button-shop-dropdown"
                        onclick="handleDropdownFirst('<?php echo $shopCat['id'] ?>')"
                        id="<?php echo $shopCat['id'] ?>">

                        <p><?php echo $shopCat['category'] ?></p>

                        <?php if (!empty($shopCat['sub-cat'])): ?>
                            <img src="../../img/icons/arrow-right.svg" alt="">


                        <?php endif ?>

                    </div>

                    <?php if (!empty($shopCat['sub-cat'])): ?>
                        <div class="container-subcategory" id='<?php echo 'shop-dropdown-category-' . $shopCat['id'] ?>'>

                            <?php foreach ($shopCat['sub-cat'] as $subCat): ?>
                                <div class="shop-dropdown-subcategory button-shop-dropdown" onclick="handleDropdownSecond('<?php echo $subCat['id'] ?>')">
                                    <?php echo $subCat['name'] ?>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>


                </div>

            <?php endforeach; ?>

        </div>
    </div>


    <div class="search">
        <form method="get">
            <input type="search" placeholder="Search here..." name="search" id="search">
        </form>
    </div>
    <div class="profile">
        <div class="cart">
            <img src="../../img/header/cart.svg" alt="" class="icon-profile" onclick="handleCart()">
        </div>
        <div class="account">
            <img src="../../img/header/person.svg" alt="" class="icon-profile" onclick="handleAccount()">
        </div>
    </div>
</div>


<script>
    // Most of these logic is for the arrow animations and shop dropdown
    let isShopMenuOpen = false;

    let isDropdownSecondOpen = false;
    let menuOpenedId = '';

    function handleShop() {
        let arrowElement = document.querySelector('.shop img');
        let shopElement = document.getElementById("shop");

        let categoryArrows = document.querySelectorAll('.shop-dropdown-category img');

        if (!isShopMenuOpen) {
            document.getElementById("shop-dropdown").classList.add("active");
            arrowElement.classList.add("active");
            shopElement.classList.add("active");
        } else {
            document.getElementById("shop-dropdown").classList.remove("active");
            let activeMenus = document.getElementsByClassName('container-subcategory');
            for (menu of activeMenus) {
                menu.classList.remove("active")
            }
            isDropdownSecondOpen = false;
            menuOpenedId = ''
            arrowElement.classList.remove("active");
            shopElement.classList.remove("active");
            for (arrow of categoryArrows) {
                arrow.classList.remove("active")
            }

        }
        isShopMenuOpen = !isShopMenuOpen;
    }


    function handleDropdownFirst(categoryId) {
        // If prebuilt go to prebuilt page
        if (categoryId === 'prebuilt') {
            const url = `/shop?category=prebuilt`;
            window.location.href = url;
            return
        }

        let id = 'shop-dropdown-category-' + categoryId
        let arrowElement = document.getElementById(categoryId).querySelector('img');

        // Else handle second dropdown logic
        if (!isDropdownSecondOpen) {
            document.getElementById(id).classList.add("active");

            // For the arrow animation
            if (arrowElement) {
                arrowElement.classList.add("active");
            }

            menuOpenedId = id;
            isDropdownSecondOpen = true;
        } else {
            let activeMenus = document.getElementsByClassName('container-subcategory');
            let activeArrows = document.querySelectorAll('.shop-dropdown-category img');

            for (menu of activeMenus) {
                menu.classList.remove("active")
            }
            for (arrow of activeArrows) {
                arrow.classList.remove("active")
            }

            if (id !== menuOpenedId) {
                document.getElementById(id).classList.add("active");

                if (arrowElement) {
                    arrowElement.classList.add("active");
                }

                menuOpenedId = id;
            } else {
                isDropdownSecondOpen = !isDropdownSecondOpen
                menuOpenedId = ''
            }

        }
    }

    function handleDropdownSecond(subcatId) {
        // console.log(subCatLow);
        const url = `/shop?category=${subcatId}`;
        window.location.href = url;
        // console.log('Shop button clicked')
    }

    function handleLogo() {
        window.location.href = '/home';
    }

    function handleAbout() {
        window.location.href = '/about';
    }

    function handleAccount() {
        window.location.href = '/profile';
    };

    function handleCart() {
        window.location.href = '/cart';
    };
</script>