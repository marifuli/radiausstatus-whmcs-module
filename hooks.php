<?php

add_hook('AdminAreaFooterOutput', 1, function($vars) {
    return get_js($vars);
});
add_hook('ClientAreaFooterOutput', 1, function($vars) {
    return get_js($vars);
});
// file_get_contents()
function get_js($vars) {
    return '
    <script>
        let apiKey = "'. $vars['api_key'] .'";
        let apiSecretKey = "'. $vars['api_secret_key'] .'";

        function generate_avc_radius_status_html(avc_id) 
        {
            let url = "/modules/addons/radiusstatus/proxy.php"
            url += "?avc_id=" + avc_id
            url += "?apiKey=" + apiKey
            url += "?apiSecretKey=" + apiSecretKey

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
            .catch(() => {})
        }
        generate_avc_radius_status_html("AVC000179231029")
    </script>';

}
