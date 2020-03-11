chrome.browserAction.onClicked.addListener(function(tab) {
    if(localStorage.length > 0){
        console.log("redirect");
        let timerId = setTimeout(redirect);
    } else {
        console.log("show index");
        chrome.browserAction.setPopup({
            popup: "index.html"
        });
    }
});
function redirect() {
    chrome.windows.create({
        url: "tab/table/table.html",
        type: "popup"
    }, function (win) {
    });
}
