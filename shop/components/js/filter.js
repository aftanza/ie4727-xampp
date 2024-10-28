function handleArrowClick(arrowNode) {
    const filterNode = arrowNode.parentNode.parentNode;
    const formNode = arrowNode.parentNode;
    if (arrowNode.classList.contains("active")) {
        arrowNode.classList.remove("active");
        filterNode.classList.remove("active");
        formNode.classList.remove("active");
        setTimeout(() => {
            filterNode.classList.remove("disable-click");
        }, 0.25);
    } else {
        arrowNode.classList.add("active");
        filterNode.classList.add("active");
    }
}

function handleFormClick(formNode) {
    const filterNode = formNode.parentNode;

    if (!filterNode.classList.contains("disable-click")) {
        filterNode.classList.add("active");
        formNode.classList.add("active");
        filterNode.classList.add("disable-click");
        const img = formNode.querySelector("img");
        if (img) {
            img.classList.add("active");
        }
    }
}

window.handleFormClick = handleFormClick;
window.handleArrowClick = handleArrowClick;
