$(document).ready(function () {
    $(".main-loader").hide();
    const forms = document.querySelectorAll(".needs-validation");
    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });

    $(".nav .btn-nav").on("click", function () {
        if ($(".nav .nav-content").is(":visible")) {
            $(".nav .nav-content").hide();
            var widthNav = 0;
        } else {
            $(".nav .nav-content").show();
            var widthNav = $(".nav .nav-content").width();
        }
        $(".data-content").animate({ marginLeft: widthNav + 40 + "px" }, 100);
        $(".data-content").css(
            "width",
            "calc(100% - " + (widthNav + 80) + "px)"
        );
    });

    $("body").on("change", ".input-image input", function () {
        var classinput = $(this).closest(".input-image");
        if (this.files && this.files[0]) {
            classinput.find(".remove").show();
            var reader = new FileReader();
            reader.onload = function (e) {
                classinput.css({ "boder-color": "#000" });
                classinput
                    .find(".preview")
                    .html("<img src='" + e.target.result + "' />");
                classinput.find(".zoom").show();
                /*$("#preview-image-"+image).show();
            $(".update-"+image).hide();
            $("#preview-image-"+image+" img").attr("src",e.target.result);
            $("#miniatura"+image+" label").hide();*/
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("body").on("click", ".input-image .remove", function () {
        var classinput = $(this).closest(".input-image");
        image = classinput.data("image");
        classinput.find("input").val("");
        if (image != "") {
            classinput.find(".preview").html("<img src='" + image + "' />");
        } else {
            classinput.find(".preview").html("");
            classinput.find(".zoom").hide();
        }
        classinput.find(".remove").hide();
    });

    $("body").on("click", ".input-image .zoom", function (e) {
        var classinput = $(this).closest(".input-image");
        var src = classinput.find(".preview img").attr("src");
        $("#imagepreview").attr("src", src); // here asign the image to the modal when the user click the enlarge link
        $("#imagemodal").modal("show"); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });

    var tags = new Bloodhound({
        limit: 10,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: "/core/tags?tag=%QUERY",
            wildcard: "%QUERY",
        },
    });
    tags.initialize();

    $(".tags").tagsinput({
        typeaheadjs: {
            source: tags.ttAdapter(),
        },
    });

    $(".inputNumerico").on("input", function () {
        $(this).val(
            $(this)
                .val()
                .replace(/[^0-9]/g, "")
        );
    });

    $("body").on("change",".update-data",function(){
        var campo = $(this).attr("name");
        var producto = $(this).data('producto');
        var value;
        console.log(campo+" "+producto);
        if($(this).attr("type") == "checkbox" ){
            if($(this).prop("checked")){
                value = 1;
            } else {
                value = 0
            }
        } else {
            value = $(this).val();
        }

        if(value !== '' ){
            var data = {};
            data.field = campo;
            data.product = producto;
            data.value = value;
            $.post("/product/setfield",data,function(res){
                console.log("envio");
            });
        } else {
            console.log("no hace nada");
        }
    });

    $("#btn-cambiar-mipaquete").on("click",function(){
        $("#login-mipaquete").show();
        $("#info-mipaquete").hide();
    });
    $("#btn-cancelar-mipaquete").on("click",function(){
        $("#login-mipaquete").hide();
        $("#info-mipaquete").show();
    });
});
