<?php
$dropdownItems_first = ['Accessories & Peripherals', 'Components', 'Pre-Built PC'];
$dropdownItems_second = [['Keyboards', 'Mice'], ['GPU', 'CPU', 'RAM'], []];

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

            <?php foreach ($dropdownItems_first as $indexFirst => $itemsFirst): ?>
                <div class="shop-dropdown-container-first">
                    <div
                        class="shop-dropdown-item-first button-shop-dropdown"
                        onclick="handleDropdownFirstOpen(<?php echo $indexFirst ?>)">
                        <?php echo $itemsFirst ?>
                    </div>

                    <div class="shop-dropdown-container-second" id='<?php echo 'shop-dropdown-first-' . $indexFirst ?>'>
                        <?php foreach ($dropdownItems_second[$indexFirst] as $itemsSecond): ?>
                            <div class="shop-dropdown-item-second button-shop-dropdown">
                                <?php echo $itemsSecond ?>
                            </div>
                        <?php endforeach; ?>
                    </div>


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
            let activeMenus = document.getElementsByClassName('shop-dropdown-container-second');
            for (menu of activeMenus) {
                menu.classList.remove("active")
            }
            isDropdownSecondOpen = false;
            menuOpenedId = ''

        }
        isShopMenuOpen = !isShopMenuOpen;
    }



    function handleDropdownFirstOpen(index) {

        let id = 'shop-dropdown-first-' + String(index)
        if (!isDropdownSecondOpen) {

            document.getElementById(id).classList.add("active");
            menuOpenedId = id;
            isDropdownSecondOpen = true;
        } else {
            let activeMenus = document.getElementsByClassName('shop-dropdown-container-second');
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
</script>