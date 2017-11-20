/* ========================================================================
 * Open eClass 3.0
* E-learning and Course Management System
* ========================================================================
* Copyright 2003-2014  Greek Universities Network - GUnet
* A full copyright notice can be read in "/info/copyright.txt".
* For a full list of contributors, see "credits.txt".
*
* Open eClass is an open platform distributed in the hope that it will
* be useful (without any warranty), under the terms of the GNU (General
		* Public License) as published by the Free Software Foundation.
* The full license can be read in "/info/license/license_gpl.txt".
*
* Contact address: GUnet Asynchronous eLearning Group,
*                  Network Operations Center, University of Athens,
*                  Panepistimiopolis Ilissia, 15784, Athens, Greece
*                  e-mail: info@openeclass.org
* ======================================================================== */

function Rate(widget, rid, rtype, value, url) {
    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            response = JSON.parse(xmlhttp.responseText);
            document.getElementById('rate_'+rid+'_up').innerHTML = response[0];
            document.getElementById('rate_'+rid+'_down').innerHTML = response[1];
            document.getElementById('rate_'+rid+'_img_up').src = response[4];
            document.getElementById('rate_'+rid+'_img_down').src = response[5];
            if (response[2] == 'ins') {
                document.getElementById('rate_msg_'+rid).innerHTML = response[3];
            } else if (response[2] == 'del' ) {
            	document.getElementById('rate_msg_'+rid).innerHTML = '';
            }
        }
    }

    xmlhttp.open("GET",url+"?widget="+widget+"&rid="+rid+"&rtype="+rtype+"&value="+value,true);

    xmlhttp.send();
}