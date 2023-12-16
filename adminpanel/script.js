$(document).ready(function() {
    loadContent("requests.php");

    function loadContent(file) {
        $.ajax({
            url: file,
            method: "GET",
            success: function(data) {
                $("#main-content").html(data);
            },
            error: function() {
                alert("Error loading content.");
            }
        });
    }

    $("#userBanLink, #postDeletionLink, #reportsLink, #requestsLink").on("click", function(event) {
        event.preventDefault();
        var phpFile = $(this).attr("href");
        loadContent(phpFile);
    });
});
