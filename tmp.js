
function generate_avc_radius_status_html(avc_id, elmentToAppend) 
{
    let url = "/modules/addons/radiusstatus/proxy.php"
    url += "?avc_id=" + avc_id 

    fetch(url, {
        method: "GET",
    })
    .then(response => {
        if (!response.ok) {
            return 
        }
        return response.text();
    })
    .then(data => { 
        $(elmentToAppend).append(data)
    })
    .catch(error => {
        // console.error("Fetch error:", error);
    })
}

//- for admin
if(
    location.href.includes("igadmin/clientsservices.php?userid")
    && document.querySelector("#servicecontent")
)
{
    // search avc input 
    let avc = ""
    document.querySelectorAll("#servicecontent input").forEach(inp => {
        if(
            inp.value.includes("AVC")
            && $(inp).parent().prev().text().toLowerCase().includes("avc")
        )
        {
            generate_avc_radius_status_html(inp.value, document.querySelector("#servicecontent"))
        }
    })
}
//- for client
if(
    location.href.includes("clientarea.php?action=productdetails&id=")
    && document.querySelector("#additionalinfo")
)
{
    // search avc input 
    document.querySelectorAll("#additionalinfo .row div.col-sm-7").forEach(div => {
        if(
            $(div).text().trim().includes("AVC")
            && $(div).prev().text().toLowerCase().includes("avc")
        )
        {
            generate_avc_radius_status_html($(div).text().trim(), document.querySelector(".product-details-tab-container"))
        }
    })
}
