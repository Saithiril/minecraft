/**
 * Created by saithiril on 05.11.14.
 */
var utils;

utils = {
    xmlhttp: (function () {
        'use strict';
        try {
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                return new ActiveXObject("Microsoft.XMLHTTP");
            } catch (ee) {
            }
        }
        if (typeof XMLHttpRequest !== 'undefined') {
            return new XMLHttpRequest();
        }
    }())
};

function like_photo(e, image_id) {
    var
        likes_count = document.getElementById('likes_count_'+image_id),
        xmlhttp = utils.xmlhttp;

    xmlhttp.open('GET', 'like_photo.php?action=inc&id='+image_id, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4)
        {
            if(xmlhttp.status==0) {
            }
            if(xmlhttp.status == 200) {
                var response = xmlhttp.responseText;
                if(response != "NO")
                    likes_count.innerHTML = response;
            }
        }
    }
    xmlhttp.send();
}

function delete_image(image_id) {
	var
        xmlhttp = utils.xmlhttp;
		
	xmlhttp.open('GET', 'like_photo.php?action=delete&id='+image_id, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4)
        {
            if(xmlhttp.status==0) {
            }
            if(xmlhttp.status == 200) {
                var response = xmlhttp.responseText;
                if(response != "NO") {
					location.reload(true);
				}
            }
        }
    }
    xmlhttp.send();
}

function activeChange(e, name) {
    'use strict'
    var
        xmlhttp = utils.xmlhttp,
        is_active = e.checked ? 1 : 0;

    xmlhttp.open('GET', 'resurces/active?is_active='+ is_active + '&name=' + name, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4)
        {
            if(xmlhttp.status==0) {
            }
            if(xmlhttp.status == 200) {
                var response = xmlhttp.responseText;
                console.log(response);
            }
        }
    }
    xmlhttp.send();
}

function deleteChange(e, name) {
    'use strict'
    var
        xmlhttp = utils.xmlhttp,
        wait_delete = e.checked ? 1 : 0;

    xmlhttp.open('GET', 'resurces/delete?wait_delete='+ wait_delete + '&name=' + name, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4)
        {
            if(xmlhttp.status==0) {
            }
            if(xmlhttp.status == 200) {
                var response = xmlhttp.responseText;
                console.log(response);
            }
        }
    }
    xmlhttp.send();
}
