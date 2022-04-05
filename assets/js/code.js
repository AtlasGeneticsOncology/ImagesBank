var request = new XMLHttpRequest();

function removeElement(node) { node.parentNode.removeChild(node); }

function create_row() {
    var row = document.createElement("div");
    row.setAttribute("class","row  justify-content-center");
    document.getElementById("gallery").appendChild(row);
    return row;
}

function show_images_gallery(element, row, legend, links, category, title) {

    
    var box = document.createElement("div");
    box.setAttribute("class","col-md-3");
    
    row.appendChild(box);

    var imageContainer = document.createElement("div");
    imageContainer.setAttribute("class","zoom");

    box.appendChild(imageContainer);
    
    var path = `assets/img/${category}/`;

    var image = document.createElement("img");
    image.setAttribute("src", path + element);
    image.setAttribute("alt", legend);
    image.setAttribute("class", "all-images");
    
    imageContainer.appendChild(image);

    
    var plegend = document.createElement("p");
    plegend.setAttribute("style", "display:none");
    plegend.innerHTML=legend+"<br>In <a href="+links+" target='_blank'>"+title+"</a>";
    
    imageContainer.appendChild(plegend);
}

function pagination(){

    var boxpagination=document.getElementById("pagbox");
    while (boxpagination.firstChild) {
        boxpagination.removeChild(boxpagination.firstChild);
    }

    for (var numpages = 1; numpages <= 10; numpages++){
        var page = document.createElement("li");
        page.setAttribute("class","page-item");
        page.setAttribute("id",numpages);
        if (numpages==1){
            page.setAttribute("class","page-item active");
        }

        boxpagination.appendChild(page);

        var enl = document.createElement("a");
        enl.setAttribute("class","page-link");
        // enl.setAttribute("href","#");
        enl.setAttribute("data",numpages);
        enl.setAttribute("onclick","pages("+numpages+")")
        enl.innerHTML=numpages;
        page.appendChild(enl);
    }
    
}

function pages(pages,request,intputText,selectCategory){
    if (pages == undefined) {
        pages=1;
    }
    console.log(pages);
    request.open('GET', 'ajax/images-in-database.php?q=' + intputText.value + "&category=" + selectCategory.value + "&pages=" +pages, true);
    request.send();
}

document.getElementsByTagName("form")[0].addEventListener("submit", function (e) {
    e.preventDefault();
    
    var intputText = document.getElementById('text');
    var selectCategory = document.getElementById("category");
    var errorMessage = document.getElementsByClassName("show-errors")[0];
    var gallery = document.getElementById('gallery');
    
    // Reset input class
    intputText.setAttribute("class", "form-control")
    errorMessage.style = "display:none"
    gallery.innerHTML = ""
    
    if (intputText.value == "" || intputText.value == " " || intputText.value.length == 0) {
        intputText.setAttribute("class", "form-control is-invalid");
        return;
    }
    
    // Send request to server


    request.onload = function () {
                

        if (this.status >= 200 && this.status < 400) {

            var data = JSON.parse(this.response);


            // Error validation
            if (data.error) {
                console.error("Error " + data.message)
                errorMessage.style = "display:block";
                return;
            }

            let position = 0;

            for (var row = 1; row <= 4; row++) {

                var newrow = create_row();

                for (var cols = 0; cols <= 3; cols++) {


                    if (data['name'][position] != undefined) {

                        show_images_gallery(data['name'][position], newrow, data['legend'][position], data['link'][position], data['categories'][position],data['title'][position]);
                        console.log(position)

                    }

                    position = position + 1

                }

            }
            pagination();

            Zoomerang
            .config({
                maxHeight: 1000,
                maxWidth: 1000,
                bgColor: '#000',
                bgOpacity: .85,
                onOpen: show_legend,
                onClose: hide_legend
            })
            .listen(".zoom")


            function show_legend(el) {
                var show_legend = el.lastChild;
                show_legend.setAttribute('style', 'display:block;');

            }

            function hide_legend(el) {
                var hide_legend = el.lastChild;
                hide_legend.setAttribute('style', 'display:none;');
            }

        } else {
            console.error("La peticion ha fallado")
            errorMessage.style = "display:block";


        }

    };

    request.onerror = function () {
        console.error("La peticion ha fallado")
        errorMessage.style = "display:block";

    };


    pages(1,request,intputText,selectCategory);
})





