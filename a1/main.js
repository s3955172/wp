function navigateToPage() {
    var pageSelect = document.getElementById("pageSelect");
    var selectedPage = pageSelect.options[pageSelect.selectedIndex].value;
    if (selectedPage) {
        window.location.href = selectedPage;
    }
}
