function removeElement(node) { node.parentNode.removeChild(node); }

function create_row() {
    var row = document.createElement("div");
    row.setAttribute("class","row  justify-content-center");
    document.getElementById("gallery").appendChild(row);
    return row;
}

function show_images_gallery(path, element, row, legend) {

    var box = document.createElement("div");
    box.setAttribute("class","col-md-3")
    row.appendChild(box);
    box.setAttribute("class", "all-boxes")

    var image = document.createElement("img");
    box.appendChild(image);
    image.setAttribute("src", path + element);
    image.setAttribute("alt", legend);
    image.setAttribute("class", "zoom all-images");
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
                            show_images_gallery(path, json['name'][cols], newrow, json['legend']);
                        }
                    }
                    json['name'].splice(0, 4);
                }


                Zoomerang
                    .config({
                        maxHeight: 1000,
                        maxWidth: 1000,
                        bgColor: '#000',
                        bgOpacity: .85,
                    })
                    .listen(".zoom")

            } else {
                alert('Error Code:' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }

    var str = document.getElementById('text').value;

    objXMLHttpRequest.open('GET', 'ajax/images-in-database.php?q=' + str, true);
    objXMLHttpRequest.send();



})



