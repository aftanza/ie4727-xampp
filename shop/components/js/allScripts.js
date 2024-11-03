import "./paging.js";
import "./filter.js";

function handleShopSort(currentSortType) {
    // console.log(currentSortType);

    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set("sort", currentSortType);

    // currentUrl.searchParams.delete("search");
    // console.log(currentUrl.searchParams);

    window.location.href = currentUrl.href;
}

function handleShopItem(shopItemId) {
    // console.log(shopItemId);
    window.location.href = "/shop/item/?id=" + shopItemId;
}

function resetURL() {
    window.location.href = "/shop/";
}

window.handleShopSort = handleShopSort;
window.handleShopItem = handleShopItem;
window.resetURL = resetURL;
