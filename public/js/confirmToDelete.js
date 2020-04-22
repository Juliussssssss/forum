$( document ).ready(function() {
    $(".delete").on("submit", function () {
        return confirm("Подвердите удаление, вы уверены в своем действии ?");
    });
});
