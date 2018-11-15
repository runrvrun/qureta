    function imgError(image) {
        image.onerror = "";
        image.src = "/uploads/post/thumb/noimage.jpg";
        return true;
    }
    function avaError(image) {
        image.onerror = "";
        image.src = "/uploads/avatar/noavatar.jpg";
        return true;
    }
    function buquError(image) {
        image.onerror = "";
        image.src = "/uploads/buqu/nocover.jpg";
        return true;
    }
