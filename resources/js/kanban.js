$(document).ready(function () {
    window.allowDrop = function (ev) {
        ev.preventDefault();
    };
    window.drag = function (ev, cardId) {
        ev.dataTransfer.setData("text", cardId);
    };
    window.drop = function (ev, targetDiv) {
        ev.preventDefault();
        let data = ev.dataTransfer.getData("text");
        let draggedElement = $("#" + data)[0];
        let targetElement = $("#" + targetDiv)[0];
        let token = $('meta[name="csrf-token"]').attr("content");
        if (targetElement && $(targetElement).hasClass("dropzone")) {
            targetElement.appendChild(draggedElement);
            let cardId = data.split("_")[1];
            let newStatus = $("#" + targetDiv).data("value");
            $.post(`/leads/${cardId}/mover/${newStatus}`, {
                _method: "PUT",
                _token: token,
            });
        }
    };
});
