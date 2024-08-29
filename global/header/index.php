<?php
$shop_categories = ['Accessories & Peripherals', 'Components', 'Pre-Built PC'];
$shop_subCategories = [['Keyboards', 'Mice'], ['GPU', 'CPU', 'RAM'], []];

?>


<div class="header">
    <div class="logo">
        <h3>logo</h3>

    </div>

    <div class="about-container">
        <div class="about button-header">
            <h3>About</h3>
        </div>

    </div>

    <div class="shop-container">
        <div class="shop button-header" id="test" onclick="handleShop()">
            <h3>Shop</h3>
        </div>

        <div class="shop-dropdown" id="shop-dropdown">

            <?php foreach ($shop_categories as $indexCat => $shopCat): ?>
                <div class="container-category">
                    <div
                        class="shop-dropdown-category button-shop-dropdown"
                        onclick="handleDropdownFirstOpen(<?php echo $indexCat ?>)">
                        <?php echo $shopCat ?>
                    </div>

                    <?php if (!empty($shop_subCategories[$indexCat])): ?>
                        <div class="container-subcategory" id='<?php echo 'shop-dropdown-category-' . $indexCat ?>'>

                            <?php foreach ($shop_subCategories[$indexCat] as $subCat): ?>
                                <div class="shop-dropdown-subcategory button-shop-dropdown" onclick="handleShopButton('<?php echo $subCat ?>')">
                                    <?php echo $subCat ?>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>


                </div>

            <?php endforeach; ?>

        </div>
    </div>


    <div class="search-bar">
        searchbar
    </div>
    <div class="profile">
        <div class="cart">
            cart
        </div>
        <div class="account">
            account
        </div>
    </div>
</div>


<script>
    let isShopMenuOpen = false;

    let isDropdownSecondOpen = false;
    let menuOpenedId = '';

    function handleShop() {
        if (!isShopMenuOpen) {
            document.getElementById("shop-dropdown").classList.add("active");
        } else {
            document.getElementById("shop-dropdown").classList.remove("active");
            let activeMenus = document.getElementsByClassName('container-subcategory');
            for (menu of activeMenus) {
                menu.classList.remove("active")
            }
            isDropdownSecondOpen = false;
            menuOpenedId = ''

        }
        isShopMenuOpen = !isShopMenuOpen;
    }



    function handleDropdownFirstOpen(index) {
        if (index == 2) {
            const url = `/shop.php?category=prebuilt`;
            window.location.href = url;
            return
        }

        let id = 'shop-dropdown-category-' + String(index)
        if (!isDropdownSecondOpen) {

            document.getElementById(id).classList.add("active");
            menuOpenedId = id;
            isDropdownSecondOpen = true;
        } else {
            let activeMenus = document.getElementsByClassName('container-subcategory');
            for (menu of activeMenus) {
                menu.classList.remove("active")
            }
            if (id !== menuOpenedId) {
                document.getElementById(id).classList.add("active");
                menuOpenedId = id;
            } else {
                isDropdownSecondOpen = !isDropdownSecondOpen
                menuOpenedId = ''
            }

        }
    }

    function handleShopButton(subcat) {
        const subCatLow = subcat.toLowerCase();
        console.log(subCatLow);
        const url = `/shop.php?category=${subCatLow}`;
        window.location.href = url;
        // console.log('Shop button clicked')
    }
    // function
</script>