$(function () {
    var body = $("body");
 
    var oudeBreedte = null;
 
    // Functie voor padding van de body en scrollbar.
    var bodyBerekenen = function () {
        var nieuweBreedte = body.width();
        if (nieuweBreedte != oudeBreedte) {
            oudeBreedte = nieuweBreedte;
 
            // Meet de scrollbar op door het eerst uit te zetten en daarna te bereken en terug tezetten in px
            body.css("overflow", "hidden");
            var scrollbarBreedte = body.width() - nieuweBreedte;
            body.css("overflow", "auto");
            body.css("margin-left", scrollbarBreedte + "px");
        }
    };
 
    // Interval voor het bereken omdat de scrollbar niet altijd gelijk zichtbaar is.
    setInterval(bodyBerekenen, 100);
    bodyBerekenen();
});