jQuery.fn.extend({
    Gallery: function (property) {
        return this.each(function (index, element) {
            let id = $(element).attr('id');
            let images = "";
            let selected_index = -1;

            init();
            function init() {

                if($(`#${id}`).has("img").length == 0)
                    return;
                
                generateModal();
                generateFunction();
            }
            function generateModal() {
                $(`#${id}`).append(`<div class="modal fade" id="${id}-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered text-center" role="document">
                        <div class="m-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="" id="${id}-image"
                                        style="max-height:calc(100vh - 200px); max-width:calc(100vw - 100px)">
                                </div>
                                <div class="modal-footer" style="align-self: center;justify-content:center" id="${id}-image-thumbnails">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`);
            }

            function generateFunction() {
                $(`#${id} > img`).each(function (index, element) {
                    images +=
                        `<img src="${element.src}" id="image-thumbnail-${index}" class="img-thumbnail shadow mr-2 mb-3 d-inline-flex" style="width:80px;height:80px;object-fit: cover;"  />`;
                    $(element).css("cursor", "pointer")

                    $(element).click(() => {
                        changeImage(element.src, index)
                        $(`#${id}-modal`).modal('show')
                    })
                })

                $(`#${id}-image-thumbnails`).html(images);

                $(`#${id}-image-thumbnails > img`).each(function (index, element) {
                    $(element).css("cursor", "pointer")

                    $(element).click(() => {
                        changeImage(element.src, index)
                    })
                })
            }

            function changeImage(src, index) {
                selected_index = index;
                $(`#${id}-image`).attr("src", src);

                $(`#${id}-image-thumbnails > img`).each(function (index, element) {
                    $(`#${id}-image-thumbnail-${index}`).removeClass("bg-primary")
                });

                $(`#${id}-image-thumbnail-${index}`).addClass("bg-primary")
            }


        });
    }
});