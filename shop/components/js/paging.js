function handlePaging(arg, value = null) {
    const currentUrl = new URL(window.location.href);
    const currentPage = parseInt(currentUrl.searchParams.get("page"));

    if (arg === "next") {
        currentUrl.searchParams.set("page", currentPage + 1);
        window.location.href = currentUrl.href;
    } else if (arg === "prev") {
        currentUrl.searchParams.set(
            "page",
            currentPage > 1 ? currentPage - 1 : 1
        );
        window.location.href = currentUrl.href;
    } else if (arg === "page") {
        currentUrl.searchParams.set("page", value);
        window.location.href = currentUrl.href;
    }
}

window.handlePaging = handlePaging;
