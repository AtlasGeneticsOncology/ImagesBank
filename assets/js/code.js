function removeElement(node) { node.parentNode.removeChild(node); }

function create_row() {
    var row = document.createElement("div");
    row.setAttribute("class","row  justify-content-center");
    document.getElementById("gallery").appendChild(row);
    return row;
}

function show_images_gallery(path, element, row, legend) {

    var box = document.createElement("div");
    box.setAttribute("class","col-md-3");
    
    row.appendChild(box);


    var imageContainer = document.createElement("div");
    imageContainer.setAttribute("class","zoom");

    box.appendChild(imageContainer);
    

    var image = document.createElement("img");
    image.setAttribute("src", path + element);
    image.setAttribute("alt", legend);
    image.setAttribute("class", "all-images");
    
    imageContainer.appendChild(image);

    
    var plegend = document.createElement("p");
    plegend.setAttribute("style", "display:none");
    plegend.innerHTML=legend+"<br><a href='#'>Read More</a>";
    
    imageContainer.appendChild(plegend);
}


document.getElementsByTagName("form")[0].addEventListener("submit", function (e) {
    e.preventDefault();

    var objXMLHttpRequest = new XMLHttpRequest();

    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                var div = document.getElementById('gallery');
                while (div.firstChild) {
                    div.removeChild(div.firstChild);
                }

                var json = JSON.parse(objXMLHttpRequest.responseText)
                var path = 'assets/img/cards_haematological/';

                for (var row = 1; row <= 4; row++) {
                    var newrow = create_row();
                    for (var cols = 0; cols <= 3; cols++) {
                        if (json['name'][cols] != undefined) {
                            show_images_gallery(path, json['name'][cols], newrow, json['legend'][cols]);
                        }
                    }
                    json['name'].splice(0, 4);
                    json['legend'].splice(0, 4);
                }

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

                    function show_legend(el){
                        var show_legend=el.lastChild;
                        // console.log(show_legend);
                        show_legend.setAttribute('style','display:block;');

                    }

                    function hide_legend(el){
                        var hide_legend=el.lastChild;
                        // console.log(hide_legend);
                        hide_legend.setAttribute('style','display:none;');
                    }

            } else {
                alert('Error Code:' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }

    var str = document.getElementById('text').value;
    let category = document.getElementById("category").value;

    objXMLHttpRequest.open('GET', 'ajax/images-in-database.php?q=' + str+"&category="+category, true);
    objXMLHttpRequest.send();



})



