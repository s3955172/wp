function navigate(url) {
    if (url) {
        console.log(`Navigating to: ${url}`); // Logs the URL being navigated to
        window.location.href = url;
    } else {
        console.error("No URL provided for navigation."); // Logs an error if URL is empty
    }
}
