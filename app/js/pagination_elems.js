window.onload = function paginationElems() {
    let pageElems = document.getElementById("page_elems");
    let mainCont = document.getElementById("main-content");
    let paginBtns = document.getElementsByClassName("pagination-link");
    let currPage = document.getElementsByClassName("is-current")[0];
    let somePage = document.querySelector("a.pagination-link");



    if (paginBtns != null) {
        Array.from(paginBtns).forEach(function (elem) {
            elem.xhrlink = elem.href;
            elem.removeAttribute("href");
            elem.addEventListener("click", paginElems);
        });
    }

    if (pageElems != null) {
        pageElems.addEventListener("change", addElems);
    }

    function addElems() {
        if (currPage == null) {
            currPage = new Object();
            currPage.innerHTML = '1';
        }
        let request = new Object();
        request.xhrlink = somePage.xhrlink;
        request.xhrlink = request.xhrlink.replace(/&page_elems=((10)|(20)|(50)){1}/g , '&page_elems=' + this.options[this.selectedIndex].value);
        request.xhrlink = request.xhrlink.replace(/\?page=[0-9]{1,5}/g , '?page=' + currPage.innerHTML);
        request.func = paginElems;
        request.func();
    }

    function paginElems() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', this.xhrlink, true);
        xhr.onload = function() {
            mainCont.innerHTML = xhr.responseText;
            Array.from(paginBtns).forEach(function (elem) {
                elem.addEventListener("click", paginElems);
            }); // after we get new data enable pagination
            paginationElems();
            return false;
        };
        xhr.send();
        Array.from(paginBtns).forEach(function (elem) {
            elem.removeEventListener("click", paginElems);
        }); // for blocking multiple clicks on page buttons
        return false;
    }
};
