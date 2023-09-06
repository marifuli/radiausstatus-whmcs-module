
function generate_avc_radius_status_html(avc_id) 
{
    let url = "/modules/addons/radiusstatus/proxy.php"
    url += '?avc_id=' + avc_id
    url += '?apiKey=' + apiKey
    url += '?apiSecretKey=' + apiSecretKey
    let err = "<span style='color: red'>API Error: Something went wrong in the ApI call. Try checking the AVC ID</span>"

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
        console.log(data);
    })
    .catch(error => {
        // console.error("Fetch error:", error);
    })
}